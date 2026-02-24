<?php

namespace App\Http\Controllers;

use App\Models\ingatlan;
use App\Models\kategoria;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IngatlanController extends Controller
{
    public function index()
    {
        $ingatlanok = Ingatlan::with('kategoria')->get();
        

        $result = $ingatlanok->map(function ($ingatlan) {
            return [
                'id' => $ingatlan->id,
                'kategoria' => $ingatlan->kategoria->nev ?? null, // Csak a név
                'leiras' => $ingatlan->leiras,
                'hirdetesDatuma' => $ingatlan->hirdetesDatuma,
                'tehermentes' => $ingatlan->tehermentes,
                'ar' => $ingatlan->ar,
                'kepUrl' => $ingatlan->kepUrl
            ];
        });
        
        return response()->json($result, 200);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kategoria' => 'required|exists:kategoriak,id',
            'tehermentes' => 'required|boolean',
            'ar' => 'required|integer|min:0',
            'leiras' => 'sometimes|string',
            'kepUrl' => 'sometimes|url|nullable'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Hiányos adatok'], 400);
        }

        $ingatlan = Ingatlan::create([
            'kategoria' => $request->kategoria,
            'leiras' => $request->leiras,
            'tehermentes' => $request->tehermentes,
            'ar' => $request->ar,
            'kepUrl' => $request->kepUrl
        ]);
        
        return response()->json(['id' => $ingatlan->id], 201);
    }

    public function destroy($id)
    {
        $ingatlan = Ingatlan::find($id);
        
        if ($ingatlan) {
            $ingatlan->delete();
            return response('', 204);
        }
        
        return response('Ingatlan nem létezik', 404);
    }
}