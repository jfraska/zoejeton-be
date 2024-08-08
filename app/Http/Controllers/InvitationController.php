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
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'subdomain' => 'required|string|max:255|unique:invitations',
            'templateId' => 'required|integer|unique:templates',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $invitation = Invitation::create([
            'title' => $request->title,
            'subdomain' => $request->subdomain,
            'userId' => Auth()->user()->id,
            'templateId' => $request->templateId,
        ]);

        return $this->sendResponse($invitation ,'Invitation successfully created.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvitationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invitation $invitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        //
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
}
