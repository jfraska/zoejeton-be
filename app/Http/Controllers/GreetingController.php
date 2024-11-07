<?php

namespace App\Http\Controllers;

use App\Models\Greeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GreetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $greeting = Greeting::owned($request->input('id'))->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 15));

        return $this->sendResponseWithMeta($greeting, "get greeting successfull");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'message' => 'required|string|max:500',
            'template_id' => 'required|string|exists:templates,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $greeting = Greeting::create([
            'name' => $request->name,
            'message' => $request->message,
            'template_id' => $request->template_id
        ]);

        return $this->sendResponse($greeting, 'greeting successfully created.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, Greeting $greeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $greeting = $this->getData($id);

        if ($greeting == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        $greeting->delete();

        return $this->respondWithMessage('greeting successfully deleted.');
    }

    protected function getData($id)
    {
        $greeting = Greeting::find($id);

        return $greeting;
    }
}
