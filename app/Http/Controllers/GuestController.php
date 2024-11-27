<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'invitation' => 'required|string|exists:invitations,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $guest = Guest::ownedByInvitation($request->input('invitation'))->filter()->sort()->with('group')->orderBy('created_at', 'desc')->paginate($request->input('per_page', 15));

        return $this->sendResponseWithMeta($guest, 'get guest successfull');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            '*.invitation_id' => 'required|string|max:255|exists:invitations,id',
            '*.name' => 'required|string|max:255',
            '*.code' => 'required|string|max:255',
            '*.address' => 'nullable|string|max:255',
            '*.category' => 'nullable|integer',
            '*.status' => 'nullable|integer',
            '*.group_id' => 'nullable|integer|exists:groups,id',
            '*.sosmed' => 'nullable|array',
            '*.attended' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $guests = [];
        foreach ($request->all() as $guest) {
            $guests[] = [
                'id' =>  Str::orderedUuid(),
                'invitation_id' => $guest['invitation_id'],
                'name' => $guest['name'],
                'code' => $guest['code'],
                'address' => $guest['address'] ?? null,
                'category' => $guest['category'] ?? null,
                'status' => $guest['status'] ?? 0,
                'group_id' => $guest['group_id'] ?? null,
                'sosmed' => isset($guest['sosmed']) ? json_encode($guest['sosmed']) : null,
                'attended' => isset($guest['attended']) ? json_encode($guest['attended']) : null,
            ];
        }

        // Insert all guests at once
        Guest::insert($guests);

        return $this->sendResponse($guest, 'Guest successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        list($guest, $err) = $this->getData($id);

        if ($err != null) return $err;

        return $this->sendResponse($guest, 'Guest successfully loaded.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        list($guest, $err) = $this->getData($id);

        if ($err != null) return $err;


        $validator = Validator::make($request->all(), [
            'invitation_id' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'category' => 'nullable|integer',
            'group_id' => 'nullable|integer|exists:groups,id',
            'status' => 'nullable|integer',
            'sosmed' => 'nullable|array',
            'attended' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $data = $request->only(['invitation_id', 'code', 'address', 'category', 'status', 'group_id']);

        if ($request->has('sosmed')) {
            $data['sosmed'] = json_encode($request->sosmed);
        }

        if ($request->has('attended')) {
            $data['attended'] = json_encode($request->attended);
        }

        $guest->fill($data);
        $guest->save();

        return $this->sendResponse($guest, 'Guest successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        list($guest, $err) = $this->getData($id);

        if ($err != null) return $err;

        $guest->delete();

        return $this->sendResponse($guest, 'Guest successfully deleted.');
    }

    protected function getData($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return array(null,  $this->sendError(self::VALIDATION_ERROR, null, $validator->errors()));
        }

        $guest =  Guest::find($id);

        if ($guest == null) {
            return array(null, $this->sendError(self::UNPROCESSABLE, "Data Not Found"));
        }

        return array($guest, null);
    }
}
