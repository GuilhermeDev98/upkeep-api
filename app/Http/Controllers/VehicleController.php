<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteVehicleRequest;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Requests\UpdateVehicleRequest;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use App\Models\User;


class VehicleController extends Controller
{
    public function index(Request $request){
    
    	$perPage = $request->query('perPage', '10');

        $vehicles = Vehicle::where('user_id', auth()->user()->id)->paginate($perPage);
        return response()->json($vehicles, 200);
    }

    public function store(StoreVehicleRequest $request){
        try {
            $vehicle = Vehicle::create($request->merge(['user_id' => auth()->user()->id])->all());
            return  response([
                "message" => "Veículo Adicionado Com Sucesso!",
                "data" => $vehicle,
                "errors" => null
            ], 201);
        }catch (Exception $e){
            return response([
                "message" => 'Erro ao Adicionar Veículo!',
                "data" => null,
                "errors" => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Vehicle $vehicle, UpdateVehicleRequest $request){
        try {
            $vehicle->fill($request->all());
            $vehicle->save();

            return  response([
                "message" => "Veículo Atualizado Com Sucesso!",
                "data" => $vehicle,
                "errors" => null
            ], 200);

        }catch (Exception $e){
            return response([
                "message" => 'Erro ao Atualizar Veículo!',
                "data" => null,
                "errors" => $e->getMessage(),
            ], 404);
        }
    }

    public function delete(Vehicle $vehicle, DeleteVehicleRequest $request){
        try {
            $vehicle->delete();

            return  response([
                "message" => "Veículo Deletado Com Sucesso!",
                "data" => null,
                "errors" => null
            ], 201);

        }catch (Exception $e){
            return response([
                "message" => 'Erro ao Deletar Veículo!',
                "data" => null,
                "errors" => $e->getMessage(),
            ], 404);
        }
    }
}
