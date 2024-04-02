<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settlement;

class SettlementController extends Controller
{
    private $perPage = 5;

    public function index(Request $request)
    {
        $query = Settlement::query();

        $search = $request->search;
        $page = $request->page ?? 1;

        if ($request->has('search')) {
            $query->where('name', 'like', "%$search%");
        }

        $query->paginate($this->getPerPage(), ['*'], 'page', $page);

        $settlements = $query->get();

        return response()->json($settlements);
    }

    public function create(Request $request)
    {
        try {
            $request->merge([
                'area_hectares' => (float)$request->area_hectares,
            ]);
            $request->validate([
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'area_hectares' => 'required|numeric',
                'hotline' => 'required|string|max:255',
                'youtube_video' => 'required|url|max:255',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'presentation' => 'nullable|file|mimes:pdf|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }

        $settlement = Settlement::create([
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'area_hectares' => $request->input('area_hectares'),
            'hotline' => $request->input('hotline'),
            'youtube_video' => $request->input('youtube_video'),
            'photo_path' => $request->file('photo') ? $request->file('photo')->storeAs(Settlement::class . '//photos/' . $settlement->id, $request->file('photo')->getClientOriginalName()) : null,
            'presentation_path' => $request->file('presentation') ? $request->file('presentation')->storeAs(Settlement::class . '//presentations/' . $settlement->id, $request->file('presentation')->getClientOriginalName()) : null,
        ]);

        return response()->json($settlement, 201);
    }

    private function getPerPage()
    {
        return $this->perPage;
    }
}
