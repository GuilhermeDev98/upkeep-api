<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeleteMaintenanceRequest;
use App\Http\Requests\StoreMaintenanceRequest;
use App\Http\Requests\UpdateMaintenanceRequest;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(Request $request){
        #TODO: remove commen
        //$user = auth()->user();
        try {

            $inTheNextDays = $request->query('InTheNextDays', '7');
            $startDate = Carbon::today();
            $endDate = Carbon::today()->addDays($inTheNextDays);

            $maintenances = Maintenance::whereBetween('date', [$startDate, $endDate])->with(['vehicle', 'user'])->get();

            return response([
                "message" => null,
                "data" => $maintenances,
                "errors" => null,
            ], 200);


        }catch (Exception $e){
            return response([
                "message" => 'Erro ao Buscar Manutenções!',
                "data" => null,
                "errors" => $e->getMessage(),
            ], 404);
        }
    }

    public function store(StoreMaintenanceRequest $request){
        try {
            $request->replace([
                'date' => Carbon::createFromFormat('d/m/Y', $request->date),
                'user_id' => 1
            ]);
            $maintenance = Maintenance::create($request->all());

            return response([
                "message" => 'Manutenção Adicionada Com Sucesso!',
                "data" => $maintenance,
                "errors" => null,
            ], 201);


        }catch (Exception $e){
            return response([
                "message" => 'Erro ao Adicionar Manutenção!',
                "data" => null,
                "errors" => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Maintenance $maintenance, UpdateMaintenanceRequest $request){
        try {
            $newData = $request->replace([
                'date' => Carbon::createFromFormat('d/m/Y', $request->date),
            ]);
            $maintenance->fill($newData->all());
            $maintenance->save();

            return  response([
                "message" => "Manutenção Atualizada Com Sucesso!",
                "data" => $maintenance,
                "errors" => null
            ], 200);

        }catch (Exception $e){
            return response([
                "message" => 'Erro ao Atualizar Manutenção!',
                "data" => null,
                "errors" => $e->getMessage(),
            ], 404);
        }
    }

    public function delete(Maintenance $maintenance, DeleteMaintenanceRequest $request){
        try {
            $maintenance->delete();

            return  response([
                "message" => "Manutenção Deletada Com Sucesso!",
                "data" => null,
                "errors" => null
            ], 201);

        }catch (Exception $e){
            return response([
                "message" => 'Erro ao Deletar Manutenção!',
                "data" => null,
                "errors" => $e->getMessage(),
            ], 404);
        }
    }
}
