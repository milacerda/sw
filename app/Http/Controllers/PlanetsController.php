<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planet;

class PlanetsController extends Controller
{
    public function __construct() {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    
    public function index()
    {
        $planets = Planet::get();
        return response()->json($planets);
    }

    public function show($parameter)
    {
        if(is_int($parameter)){
            $planet = Planet::find($parameter);
        } else {
            $planet = Planet::where('nome', $parameter)->get();
        }

        if(!$planet) {
            return response()->json([
                'message'   => 'Planet not found',
            ], 404);
        }

        return response()->json($planet);
    }

    public function store(Request $request)
    {
        $planet = new Planet();
        $planet->fill($request->all());
        $planet->save();

        return response()->json($planet, 201);
    }

    public function update(Request $request, $id)
    {
        $planet = Planet::find($id);

        if(!$planet) {
            return response()->json([
                'message'   => 'Planet not found',
            ], 404);
        }

        $planet->fill($request->all());
        $planet->save();

        return response()->json($planet);
    }

    public function destroy($id)
    {
        $planet = Planet::find($id);

        if(!$planet) {
            return response()->json([
                'message'   => 'Planet not found',
            ], 404);
        }

        $planet->delete();
    }

}
