<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Cars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function getYears($brand_id){
        $data = [];
        $cars = DB::table('car')->where("brand_id",$brand_id)->distinct()->get(["year"]);
        $years = [];
        foreach ($cars as $car)
            $years[] = [ "year" => $car->year ];

        $data["years"] = $years;

        return response(json_encode($data), 200);
    }

    public function getModels($brand_id, $year){
        $data = [];
        $cars = DB::table('car')->where("brand_id",$brand_id)->where("year",$year)->distinct()->get(["name"]);
        $models = [];
        foreach ($cars as $car)
            $models[] = [ "model" => $car->name ];

        $data["models"] = $models;

        return response(json_encode($data), 200);
    }

    public function getEngine($brand_id, $year, $model){
        $data = [];
        $cars = DB::table('car')->where("brand_id",$brand_id)->where("year",$year)->where("name",$model)->distinct()->get(["engine"]);
        $engines = [];
        foreach ($cars as $car)
            $engines[] = [ "engine" => $car->engine ];

        $data["engines"] = $engines;

        return response(json_encode($data), 200);
    }

    public function getCar($brand_id, $year, $model){
        $data = [];
        $cars = DB::table('car')->where("brand_id",$brand_id)->where("year",$year)->where("name",$model)->distinct()->first();
        $brand_id  = Brand::find($cars->brand_id);
        $car = [ "year" => $cars->year, "model" => $cars->name, "engine" => $cars->engine, "brand" => $brand_id->name];
        $data = $car;

        return response(json_encode($data), 200);
    }

    public function getCase(){
        $case = [];
        $id = DB::select(DB::raw("select * from cases where status = 1"))[0]->id;
        $case["cases_systems"] = DB::select(DB::raw("select s.id, s.name 
                                                                     from cases_systems cs
                                                                     join system s on s.id = cs.system_id
                                                                     where cs.case_id =".$id));
        $case["cases_codes"] = DB::select(DB::raw("select fc.id, fc.name, fc.description
                                                                     from cases_failurescodes cf
                                                                     join failure_codes fc on fc.id = cf.failure_codes_id
                                                                     where cf.case_id =".$id));
        $case["cases_parameters"] = DB::select(DB::raw("select p.id, p.name, cp.value 
                                                                     from cases_parameters cp
                                                                     join parameters p on p.id = cp.parameter_id
                                                                     where cp.case_id =".$id));

        return response(json_encode($case), 200);
    }
}
