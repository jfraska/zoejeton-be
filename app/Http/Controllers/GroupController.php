<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $group = Group::orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 15));

        return $this->sendResponseWithMeta($group, 'get group successfull');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $group = Group::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'schedule' => $request->schedule,
        ]);

        return $this->sendResponse($group, 'Group successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $group = $this->getData($id);

        if ($group == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        return $this->sendResponse($group, 'Group successfully loaded.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $group = $this->getData($request->id);

        $group->update([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'schedule' => $request->schedule,
        ]);

        return $this->sendResponse($group, 'Group successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $group = $this->getData($request->id);

        if ($group == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        $group->delete();

        return $this->sendResponse($group ,'Group successfully deleted.');
    }

    protected function getData($id)
    {
        return Group::where('id', $id)->first();
    }
}
