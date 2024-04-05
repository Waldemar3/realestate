<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\CurrencyRate;
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

        $rubRate = CurrencyRate::where('currency', 'RUB')->value('rate');
    
        if ($this->isValidColumnForSorting($sortType) && $sortBy) {
            $sortBy = in_array($sortBy, ['asc', 'desc']) ? $sortBy : 'desc';
            $query->orderBy($sortType, $sortBy);
        }

        if ($request->has('search')) {
            $query->where('name', 'like', "%$search%");
        }

        $query->paginate($this->getPerPage(), ['*'], 'page', $page);

        $query->selectRaw('*, price_usd * ? as price_rub', [$rubRate]);

        $houses = $query->orderBy('id', 'desc')->with('settlement')->get();

        return response()->json($houses);
    }

    public function create(Request $request)
    {
        try {
            $validatedData = $this->validateHouse($request);

            $house = House::create($validatedData);

            return response()->json(['message' => 'Дом успешно создан', 'house' => $house], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function update(Request $request)
    {
        try {
            $house = House::findOrFail($request->id);

            $validatedData = $this->validateHouse($request);

            $house->update($validatedData);

            return response()->json(['message' => 'Дом успешно обновлен', 'house' => $house]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function delete(Request $request){
        $id = $request->input('id');
        $house = House::findOrFail($id);
        $house->delete();

        return response()->json(['message' => 'Дом успешно удалено']);
    }

    public function validateHouse(Request $request)
    {
        $request->merge([
            'price_usd' => (float)$request->price_usd,
            'floors' => (int)$request->floors,
            'bedrooms' => (int)$request->bedrooms,
            'area' => (float)$request->area,
        ]);

        return $request->validate([
            'name' => 'required|string',
            'price_usd' => 'required|numeric',
            'floors' => 'required|integer',
            'bedrooms' => 'required|integer',
            'area' => 'required|numeric',
            'type' => 'required|string',
            'settlement_id' => 'required|exists:settlements,id', 
        ]);
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
