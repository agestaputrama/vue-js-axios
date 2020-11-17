<?php

namespace App\Http\Controllers;
use App\Peserta;
use App\Http\Resources\PesertaResource;

use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index(){
        $pesertas = Peserta::all();

        return PesertaResource::collection($pesertas);
    }

    public function store(Request $request){
         $peserta = Peserta::create([
             'name' => $request->name,
         ]);

         return $peserta;
    }

    public function delete($id){
        Peserta::destroy($id);
        return 'succes';
    }

    public function update(Request $request, $id){
        $peserta = Peserta::find($id);
        $peserta->name = $request->name;
        $peserta->save();
        

        return new PesertaResource($peserta);
        
    }
}
