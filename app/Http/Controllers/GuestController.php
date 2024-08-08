<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $guest = Guest::orderBy('created_at', 'desc')
        ->cursorPaginate($request->input('per_page', 15));

        return $this->sendResponseWithMeta($guest, 'get guest successfull');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string|max:255',
            'invitationId' => 'required|string|max:255',
            'no' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'additional' => 'nullable|json',
            'sosmed' => 'nullable|json',
            'attended' => 'nullable|json',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $template = Guest::create([
            'id' => $request->id,
            'invitationId' => $request->invitationId,
            'no' => $request->no,
            'name' => $request->name,
            'additional' => $request->additional,
            'sosmed' => $request->sosmed,
            'attended' => $request->attended,
        ]);

        return $this->sendResponse($template ,'Invitation successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $guest = $this->getData($id);

        if ($guest == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        return $this->sendResponse($guest ,'Guest successfully loaded.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function getData($id)
    {
        return Guest::where('id', $id)->first();
    }
}
