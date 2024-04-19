<?php

namespace App\Http\Controllers;

use App\Models\CategoryHotel;
use Illuminate\Http\Request;

class CategoryHotelController extends Controller
{
    public function index()
    {
        $categoryHotels = CategoryHotel::all();
        return response()->json($categoryHotels);
    }

    public function store(Request $request)
    {
        $categoryHotel = CategoryHotel::create($request->all());
        return response()->json($categoryHotel, 201);
    }

    public function show(CategoryHotel $categoryHotel)
    {
        return response()->json($categoryHotel);
    }

    public function update(Request $request, CategoryHotel $categoryHotel)
    {
        $categoryHotel->update($request->all());
        return response()->json($categoryHotel, 200);
    }

    public function destroy(CategoryHotel $categoryHotel)
    {
        $categoryHotel->delete();
        return response()->json(null, 204);
    }

    public function showById($id)
    {
        $categoryHotel = CategoryHotel::findOrFail($id);
        return response()->json($categoryHotel);
    }
}