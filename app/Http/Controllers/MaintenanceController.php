<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(Request $request){
        //$user = auth()->user();
        try {

            $inTheNextDays = $request->query('InTheNextDays', '7');
            $startDate = Carbon::today();
            $endDate = Carbon::today()->addDays($inTheNextDays);

            $maintenances = Maintenance::whereBetween('date', [$startDate, $endDate])->get();

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
}
