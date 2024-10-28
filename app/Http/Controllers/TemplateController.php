<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $template = Template::filter()->sort()->orderBy('created_at', 'desc')
            ->paginate($request->input('per_page', 15));

        return $this->sendResponseWithMeta($template, 'get template successfull');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'thumbnail' => 'nullable|string|max:255',
            'price' => 'nullable|integer',
            'category' => 'nullable|string|max:255',
            'discount' => 'nullable|integer',
            'content' => 'required|array',
            'color' => 'required|array',
            'music' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $template = Template::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'thumbnail' => $request->thumbnail ?? null,
            'price' => $request->price ?? null,
            'discount' => $request->discount ?? null,
            'category' => $request->category ?? null,
            'content' => $request->content,
            'color' => $request->color,
            'music' => $request->music,
        ]);

        return $this->sendResponse($template, 'Invitation successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $template = $this->getData($id);

        if ($template == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        return $this->sendResponse($template, 'Template successfully loaded.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $template = $this->getData($id);

        if ($template == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|string|max:255',
            'price' => 'nullable|integer',
            'discount' => 'nullable|integer',
            'category' => 'nullable|string|max:255',
            'music' => 'nullable|string|max:255',
            'content' => 'nullable|array',
            'color' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $data = $request->only([
            'title',
            'slug',
            'thumbnail',
            'price',
            'discount',
            'category',
            'music',
            'content',
            'color',
        ]);

        $template->fill($data);
        $template->save();


        return $this->sendResponse($template, 'Template successfully updated.');
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
        $template = Template::where('slug', $id)
            ->where('category', '!=', 'user')
            ->first();

        return $template;
    }
}
