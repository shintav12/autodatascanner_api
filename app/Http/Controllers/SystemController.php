<?php

namespace App\Http\Controllers;
use App\Models\Systems;
use App\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{
    public function get(){
        $data = [];
        $system_parsed = [];
        $systems_data = Systems::get();
        foreach ($systems_data as $system)
            $system_parsed[] = [ "id" => $system->id, "name" => $system->name ];

        $data["system"] = $system_parsed;

        return response(json_encode($data), 200);
    }

    public function Options($father_slug = "", $system = 1){
        $data = [];
        $system_parsed = [];
        $systems_data = Options::where("father_slug", $father_slug)->where("system_id",$system)->get();
        foreach ($systems_data as $system)
            $system_parsed[] = [ "id" => $system->id, "name" => $system->name ];

        $data["system"] = $systems_data;

        return response(json_encode($data), 200);
    }

    public function father($slug){
        $data = [];
        $systems_data = Options::where("slug", $slug)->first();

        $data["system"] = $systems_data;

        return response(json_encode($data), 200);
    }
}
