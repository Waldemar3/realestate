<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settlement;
use Illuminate\Support\Facades\Storage;

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

        $settlements = $query->orderBy('id', 'desc')->get();

        return response()->json($settlements);
    }

    public function create(Request $request)
    {
        try{
            $validateSettlement = $this->validateSettlement($request);

            $settlement = Settlement::create($validateSettlement);

            if ($request->hasFile('photo') || $request->hasFile('presentation')) {
                $request->validate([
                    'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'presentation' => 'nullable|file|mimes:pdf|max:2048',
                ]);

                $photoPath = $request->file('photo') ? $request->file('photo')->storeAs('Settlement/photos/' . $settlement->id, $request->file('photo')->getClientOriginalName()) : null;
                $settlement->photo_path = $photoPath;

                $presentationPath = $request->file('presentation') ? $request->file('presentation')->storeAs('Settlement/presentations/' . $settlement->id, $request->file('presentation')->getClientOriginalName()) : null;
                $settlement->presentation_path = $presentationPath;

                $settlement->save();
            }

            return response()->json($settlement, 201);
        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function update(Request $request)
    {
        try {
            $settlement = Settlement::findOrFail($request->id);

            $validateSettlement = $this->validateSettlement($request);

            $settlement->update($validateSettlement);

            return response()->json(['message' => 'Поселок успешно обновлен']);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function validateSettlement(Request $request)
    {
        $request->merge([
            'area' => (float)$request->area,
        ]);

        return $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'area' => 'required|numeric',
            'hotline' => 'required|string|max:255',
            'youtube_video' => 'required|url|max:255',
        ]);
    }    

    public function delete(Request $request){
        $id = $request->input('id');
        $settlement = Settlement::findOrFail($id);
        $filePathPhoto = Storage::path($settlement->photo_path);
        $filePathPdf = Storage::path($settlement->presentation_path);

        if(Storage::exists($filePathPhoto)){
            Storage::delete($filePathPhoto);
        }
        if(Storage::exists($filePathPdf)){
            Storage::delete($filePathPdf);
        }

        $settlement->delete();

        return response()->json(['message' => $filePathPhoto]);
    }

    private function getPerPage()
    {
        return $this->perPage;
    }
}
