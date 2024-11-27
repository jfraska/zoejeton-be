<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $invitation = Invitation::owned()->filter()->sort()->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 15));

        return $this->sendResponseWithMeta($invitation, "get invitation successfull");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:20',
            'subdomain' => 'required|string|max:20|unique:invitations',
            'template_id' => 'nullable|string|exists:templates,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $invitation = Invitation::create([
            'title' => $request->title,
            'subdomain' => $request->subdomain,
            'user_id' => Auth::id(),
            'template_id' => $request->template_id ?? null,
        ]);

        $invitation->subscription()->create();

        return $this->sendResponse($invitation, 'Invitation successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        list($invitation, $err) = $this->getData($id);

        if ($err != null) return $err;

        $invitation->load(['template', 'subscription']);

        return $this->sendResponse($invitation, 'Invitation successfully loaded.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        list($invitation, $err) = $this->getData($id);

        if ($err != null) return $err;

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'subdomain' => 'nullable|string|max:255|unique:invitations',
            'meta' => 'nullable|array',
            'published' => 'nullable|boolean',
            'template_id' => 'integer|exists:templates,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $data = $request->only(['title', 'subdomain', 'template_id', 'published']);

        if ($request->has('meta')) {
            $data['meta'] = $request->meta;
        }

        $invitation->fill($data);
        $invitation->save();

        return $this->sendResponse($invitation, 'Invitation successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        list($invitation, $err) = $this->getData($id);

        if ($err != null) return $err;

        $invitation->delete();

        return $this->respondWithMessage('Invitation successfully deleted.');
    }

    protected function getData($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return array(null,  $this->sendError(self::VALIDATION_ERROR, null, $validator->errors()));
        }

        $invitation = Invitation::where(function ($query) use ($id) {
            if (Str::isUuid($id)) {
                $query->where('id', $id);
            } else {
                $query->where('subdomain', $id);
            }
        })->first();

        if ($invitation == null) {
            return array(null, $this->sendError(self::UNPROCESSABLE, "Data Not Found"));
        }

        return array($invitation, null);
    }
}
