<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Planet;
use GuzzleHttp\Client;

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
                'message'   => 'Planeta não encontrado',
            ], 404);
        }

        return response()->json($planet);
    }

    public function store(Request $request)
    {
        $planet = new Planet();
        $planet->fill($request->all());
        $filmes = $this->getMovies($planet->nome);
        $planet->filmes = $filmes;
        $planet->save();
        return response()->json($planet, 201);
    }

    public function getMovies($planet)
    {
        $client = new Client();
        $res = $client->get('https://swapi.co/api/planets/?search='.$planet);
        
        // No caso de erro de SSL
        // $res = $client->request('GET', 'https://swapi.co/api/planets/?search='.$planet, ['verify' => false]);

        $status = $res->getStatusCode();
        if($status == 200){
            $data = json_decode($res->getBody(), true);
            return count($data['results'][0]['films']);
        }
    }

    public function update(Request $request, $id)
    {
        $planet = Planet::find($id);

        if(!$planet) {
            return response()->json([
                'message'   => 'Planeta não encontrado',
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
                'message'   => 'Planeta não encontrado',
            ], 404);
        }

        $planet->delete();
        return response()->json([
                'message'   => 'Planeta excluído com sucesso',
            ], 204);
    }

}
