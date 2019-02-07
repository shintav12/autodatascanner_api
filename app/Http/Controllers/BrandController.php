<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

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
}
