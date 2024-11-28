<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        list($invitation, $err) = $this->getData($id);

        if ($err != null) return $err;

        $validator = Validator::make($request->all(), [
            'type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $mediaItems = $invitation->getMedia($request->type);

        $totalSize = 0;
        $mediaData = [];

        foreach ($mediaItems as $media) {
            $mediaData[] = [
                'url' => $media->getFullUrl(),
                'mime_type' => $media->mime_type,
                'size' => $media->size / 1024 / 1024,
            ];
            $totalSize += $media->size;
        }

        return $this->respondWithFile($mediaData, $totalSize, "get Media successfull");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        list($invitation, $err) = $this->getData($id);

        if ($err != null) return $err;

        $validator = Validator::make($request->all(), [
            'file' => 'required|file|max:51200',
            'type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $invitation->addMedia($request->file('file'))->toMediaCollection($request->type);

        return $this->sendResponse($invitation->getMedia($request->type), 'Media successfully uploaded.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
    public function destroy(Request $request, $id)
    {
        list($invitation, $err) = $this->getData($id);

        if ($err != null) return $err;

        $validator = Validator::make($request->all(), [
            'index' => 'required|integer',
            'type' => 'required|string'
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $mediaItems = $invitation->getMedia($request->type);
        $mediaItems[$request->index]->delete();

        return $this->sendResponse($mediaItems[$request->index], "Media deleted successfull");
    }

    protected function getData($id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return array(null,  $this->sendError(self::VALIDATION_ERROR, null, $validator->errors()));
        }

        $invitation = Invitation::find($id);

        if ($invitation == null) {
            return array(null, $this->sendError(self::UNPROCESSABLE, "Data Not Found"));
        }

        return array($invitation, null);
    }

    private function respondWithFile($file, $storage, $message)
    {
        $data['files'] =  $file;
        $data['storage_usage'] = $storage;

        return $this->sendResponse($data, $message);
    }
}
