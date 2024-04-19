<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return response()->json($regions);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'unique:regions'],
            'image' => 'nullable|string',
            'description' => 'nullable|string',
            'score' => ['nullable', 'numeric', 'between:0,5'], // Ensure score is between 0 and 5
        ]);
    
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        $region = Region::create($validator->validated());
        return response()->json($region, 201);
    }

    public function show(Region $region)
    {
        return response()->json($region);
    }

    public function update(Request $request, Region $region)
{
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'string', Rule::unique('regions')->ignore($region->id)],
        'image' => 'nullable|string',
        'description' => 'nullable|string',
        'score' => ['nullable', 'numeric', 'between:0,5'], // Ensure score is between 0 and 5
    ]);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    $region->update($validator->validated());
    return response()->json($region, 200);
}

    public function destroy(Region $region)
    {
        $region->delete();
        return response()->json(null, 204);
    }
}
