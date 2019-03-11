<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function get(){
        $data = [];

        $brands = Brand::get();
        $parsed_brand = [];
        foreach ($brands as $brand)
            $parsed_brand[] = [ "id" => $brand->id, "name" => $brand->name];

        $data["brands"] = $parsed_brand;
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
