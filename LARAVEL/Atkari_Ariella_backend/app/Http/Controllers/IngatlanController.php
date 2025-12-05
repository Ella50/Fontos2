<?php

namespace App\Http\Controllers;

use App\Models\Ingatlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IngatlanController extends Controller
{
    /**
     * DISPLAY
     */
    public function index()
    {
        $ingatlanok = Ingatlan::with('kategoria')->get(); //kategoria neveket is meg kell jeleniteni
        return response()->json($ingatlanok);
    }

    /**
     * STORE
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategoria' => 'required',
            'tehermentes' => 'required',
            'ar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([ 'message' => 'Hiányzó adatok'],400);
        }

        $ingatlan = Ingatlan::create($request->all());

        return response()->json(['id' => $ingatlan->id], 201);
    }

    /**
     * DISPLAY
     */
    public function show(ingatlan $ingatlan)
    {
        
    }

    /**
     * UPDATE
     */
    public function update(Request $request, ingatlan $ingatlan)
    {
        //
    }

    /**
     * REMOVE
     */
    public function destroy(ingatlan $ingatlan)
    {
        //
    }
}
