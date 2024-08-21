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
        $template = Template::orderBy('created_at', 'desc')
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
            'thumbnail' => 'required|string|max:255',
            'price' => 'required|integer',
            'category' => 'required|string|max:255',
            'music' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:templates',
            'parent' => 'nullable|string|max:255',
            'discount' => 'nullable|integer',
            'content' => 'required|array',
            'color' => 'required|array',
            'meta' => 'nullable|json',
            'published' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $template = Template::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'parent' => $request->parent,
            'thumbnail' => $request->thumbnail,
            'price' => $request->price,
            'discount' => $request->discount,
            'category' => $request->category,
            'content' => $request->content,
            'color' => $request->color,
            'music' => $request->music,
            'meta' => $request->meta,
            'published' => $request->published,
        ]);

        return $this->sendResponse($template, 'Invitation successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $template = $this->getData($slug);

        if ($template == null) {
            return $this->sendError(self::UNPROCESSABLE, null);
        }

        return $this->sendResponse($template, 'Template successfully loaded.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'thumbnail' => 'required|string|max:255',
            'price' => 'required|integer',
            'category' => 'required|string|max:255',
            'music' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'parent' => 'nullable|string|max:255',
            'discount' => 'nullable|integer',
            'content' => 'required|array',
            'color' => 'required|array',
            // 'meta' => 'nullable|json',
            'published' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError(self::VALIDATION_ERROR, null, $validator->errors());
        }

        $template = $this->getData($request->id);

        $template->update([
            'title' => $request->title,
            'parent' => $request->parent,
            'thumbnail' => $request->thumbnail,
            'price' => $request->price,
            'discount' => $request->discount,
            'category' => $request->category,
            'content' => $request->content,
            'color' => $request->color,
            'music' => $request->music,
            'meta' => $request->meta,
            'published' => $request->published,
        ]);

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
        return Template::where('slug', $id)->orWhere('id', $id)->first();
    }
}
