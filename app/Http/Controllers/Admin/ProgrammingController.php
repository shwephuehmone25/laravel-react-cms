<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Programming;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProgrammingController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programmings = Programming::get();

        if ($programmings->isEmpty())
        {
            return response()->json([
                'message' => 'No programmings found.',
                'data' => [],
                'status' => 404
            ], 404);
        }

        return response()->json([
            'data' => $programmings,
            'status' => 200
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:programmings,name',
            'slug' => 'required|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors(), 'status' => 422]);
        }

        try {
            $programming = new Programming();
            $programming->name = $request->input('name');
            $programming->slug = $request->input('slug');
            $programming->save();

            return response()->json(['message' => 'Programming is created successfully', 'data' => $programming, 'status' => 201], 201);
        } catch (\Exception $e)
        {
            return response()->json(['error' => 'Programming creation failed', 'message' => $e->getMessage(), 'status' => 500], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Programming $programming)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255' . $programming->id,
                'slug' => 'required|string|max:255',
            ]);

            if ($validator->fails()) 
            {
                return response()->json(['errors' => $validator->errors(), 'status' => 422]);
            }

            DB::beginTransaction();

            $programming->update([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
            ]);

            $programming->save();

            DB::commit();

            return response()->json(['message' => 'Programming is updated successfully', 'data' => $programming, 'status' => 200]);
        } catch (\Exception $e) 
        {
            DB::rollback();

            return response()->json(['message' => 'Failed to update', 'error' => $e->getMessage(), 'status' => 500]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Programming $programming)
    {
        $programming->delete();

        return response()->json(['message' => 'Programming is deleted successfully', 'status' => 204]);
    }
}
