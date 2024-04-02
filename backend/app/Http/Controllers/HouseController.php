<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\House;

class HouseController extends Controller
{
    private $perPage = 5;

    public function index(Request $request)
    {
        $query = House::query();

        $search = $request->search;
        $page = $request->page ?? 1;

        $sortType = $request->sort_type;
        $sortBy = $request->sort_by;
    
        if ($this->isValidColumnForSorting($sortType) && $sortBy) {
            $sortBy = in_array($sortBy, ['asc', 'desc']) ? $sortBy : 'asc';
            $query->orderBy($sortType, $sortBy);
        }

        if ($request->has('search')) {
            $query->where('name', 'like', "%$search%");
        }

        $query->paginate($this->getPerPage(), ['*'], 'page', $page);

        $houses = $query->get();

        return response()->json($houses);
    }

    public function create(Request $request)
    {
        try {
            $request->merge([
                'price_usd' => (float)$request->price_usd,
                'floors' => (int)$request->floors,
                'bedrooms' => (int)$request->bedrooms,
                'area' => (float)$request->area,
            ]);
            $request->validate([
                'name' => 'required|string',
                'price_usd' => 'required|numeric',
                'floors' => 'required|integer',
                'bedrooms' => 'required|integer',
                'area' => 'required|numeric',
                'type' => 'required|string',
                'settlement_id' => 'required|exists:settlements,id', 
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $house = House::create($request->all());

        return response()->json($house, 201);
    }

    private function isValidColumnForSorting($column)
    {
        $columns = Schema::getColumnListing('houses');

        return in_array($column, $columns);
    }

    private function getPerPage()
    {
        return $this->perPage;
    }
}
