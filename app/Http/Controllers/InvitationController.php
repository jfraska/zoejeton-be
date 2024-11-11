<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
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
        $invitation = $this->getData($id);

        if ($invitation == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        $invitation->load(['template', 'subscription']);

        return $this->sendResponse($invitation, 'Invitation successfully loaded.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $invitation = $this->getData($id);

        if ($invitation == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

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
            $data['meta'] = json_encode($request->meta);
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
        $invitation = $this->getData($id);

        if ($invitation == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        $invitation->delete();

        return $this->respondWithMessage('Invitation successfully deleted.');
    }

    protected function getData($id)
    {
        $invitation = Invitation::where(function ($query) use ($id) {
            $query->where('id', $id)
                ->orWhere('subdomain', $id);
        })->first();

        return $invitation;
    }
}
