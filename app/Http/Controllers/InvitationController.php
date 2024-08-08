<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Http\Requests\StoreInvitationRequest;
use App\Http\Requests\UpdateInvitationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $invitation = Invitation::orderBy('created_at', 'desc')
        ->cursorPaginate($request->input('per_page', 15));

        return $this->sendResponseWithMeta($invitation, 'get invitation successfull');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'subdomain' => 'required|string|max:255|unique:invitations',
            'templateId' => 'nullable|integer|exists:templates,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $invitation = Invitation::create([
            'id' => $request->id,
            'title' => $request->title,
            'subdomain' => $request->subdomain,
            'userId' => Auth()->user()->id,
            'templateId' => $request->templateId,
        ]);

        return $this->sendResponse($invitation ,'Invitation successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invitation = $this->getData($id);

        if ($invitation == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        return $this->sendResponse($invitation ,'Invitation successfully loaded.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvitationRequest $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invitation $invitation)
    {
        //
    }

    protected function getData($id)
    {

        return Invitation::with('payment')->where('id', $id)->first();
    }
}
