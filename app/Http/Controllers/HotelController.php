<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $hotels = Hotel::all();
        return response()->json($hotels);
    }
    public function findById($id)
    {
        $hotel = Hotel::find($id);

        if (!$hotel) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }

        return response()->json($hotel);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'city' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'promotion' => 'nullable|string',
            'price' => 'required|numeric',
            'review' => ['required', 'regex:/^\d+(\.\d{1})?$/'],
            'starnumber'=>'nullable|string',
            'category_hotel_id' => 'required|exists:category_hotels,id',
            'region_id' => 'required|exists:regions,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $hotel = Hotel::create($validator->validated());
        return response()->json($hotel, 201);
    }

    public function show(Hotel $hotel)
    {
        return response()->json($hotel);
    }

    public function update(Request $request, Hotel $hotel)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'city' => 'nullable|string',
            'contact_phone' => 'nullable|string',
            'promotion' => 'nullable|string',
            'price' => 'nullable|numeric',
            'review' => ['required', 'regex:/^\d+(\.\d{1})?$/'],
            'starnumber'=>'nullable|string',
            'category_hotel_id' => 'exists:category_hotels,id',
            'region_id' => 'exists:regions,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $hotel->update($validator->validated());
        return response()->json($hotel, 200);
    }

    public function destroy(Hotel $hotel)
    {
        $hotel->delete();
        return response()->json(null, 204);
    }
    public function filterByStarNumber(Request $request)
    {
        $starNumber = $request->input('star_number');
        $hotels = Hotel::whereHas('category', function ($query) use ($starNumber) {
            $query->where('starnumber', $starNumber);
        })->get();

        return response()->json($hotels);
    }
}