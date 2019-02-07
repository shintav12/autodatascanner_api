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
}
