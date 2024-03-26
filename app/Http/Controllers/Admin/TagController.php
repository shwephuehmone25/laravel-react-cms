<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::get();

        if ($tags->isEmpty())
        {
            return response()->json([
                'message' => 'No tags found.',
                'data' => [],
                'status' => 404
            ], 404);
        }

        return response()->json([
            'data' => $tags,
            'status' => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:tags,name',
            'slug' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors(), 'status' => 422]);
        }

        try {
            $tag = new Tag();
            $tag->name = $request->input('name');
            $tag->slug = $request->input('slug');
            $tag->save();

            return response()->json(['message' => 'Tag is created successfully', 'data' => $tag, 'status' => 201], 201);
        } catch (\Exception $e)
        {
            return response()->json(['error' => 'Tag creation failed', 'message' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255' . $tag->id,
                'slug' => 'required|string|max:255',
            ]);

            if ($validator->fails()) 
            {
                return response()->json(['errors' => $validator->errors(), 'status' => 422]);
            }

            DB::beginTransaction();

            $tag->update([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
            ]);

            $tag->save();

            DB::commit();

            return response()->json(['message' => 'Tag is updated successfully', 'data' => $tag, 'status' => 200]);
        } catch (\Exception $e) 
        {
            DB::rollback();

            return response()->json(['message' => 'Failed to update the tag', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();

        return response()->json(['message' => 'Tag is deleted successfully', 'status' => 204]);
    }
}
