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
        $guest = Guest::filter()->sort()->orderBy('created_at', 'desc')->paginate($request->input('per_page', 15));

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
        $guest = $this->getData($id);

        return $this->sendResponse($guest, 'Guest successfully loaded.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $guest = $this->getData($id);

        $validator = Validator::make($request->all(), [
            'invitation_id' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'name' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'category' => 'nullable|integer',
            'status' => 'nullable|integer',
            'sosmed' => 'nullable|array',
            'attended' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $data = $request->only(['invitation_id', 'code', 'address', 'category', 'status']);

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
        $guest = $this->getData($id);

        $guest->delete();

        return $this->sendResponse($guest, 'Guest successfully deleted.');
    }

    protected function getData($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|string|max:255|exists:guests,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError('VALIDATION_ERROR', null, $validator->errors());
        }

        $guest =  Guest::find($id);

        if ($guest == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        return $guest;
    }
}
