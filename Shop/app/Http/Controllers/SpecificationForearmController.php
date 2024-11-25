<?php

namespace App\Http\Controllers;

use App\Models\SpecificationForearm;
use Illuminate\Http\Request;
use App\Models\Prosthes;
class SpecificationForearmController extends Controller
{
    public function store(Request $request)
    {   
       
        $specification = new SpecificationForearm;

        $specification->category_id = 2;// $request->input('cat_id');
        $specification->product_type = $request->input('type');
        $specification->type_of_side = $request->input('sides');
        $specification->max_fingers_load = $request->input('max_fingers_load');
        $specification->max_weight = $request->input('max_w');
        $specification->working_time = $request->input('working_time');
        $specification->functions = $request->input('functions');
        $specification->color = $request->input('color');
        $specification->material = $request->input('material');

        $specification->save();

        $spec_info = [];
        $spec_info[] = $specification->id;
        $spec_info[] = $specification->getTable();
        return $spec_info;
    }

    public function update($id, Request $request)
    {   
        
        $prosthes = Prosthes::findOrFail($id);

        $specification = SpecificationForearm::where('category_id',2)->where('id', $prosthes->specifiable_id)->first();
        
        if($specification){
            $specification->update([
                'category_id' => $request->input('cat_id'),
                'product_type' => $request->input('type'),
                'type_of_side' => $request->input('sides'),
                'max_fingers_load' => $request->input('max_fingers_load'),
                'max_weight' => $request->input('max_w'),
                'working_time' => $request->input('working_time'),
                'functions' => $request->input('functions'),
                'color' => $request->input('color'),
                'material' => $request->input('material')
            ]);
            $specification = $specification->fresh();
            $spec_info = [];
            $spec_info[] = $specification->id;
            $spec_info[] = $specification->getTable();
            return $spec_info;
        }
        else{
            $spec_info = $this->store($request);
            return $spec_info;
        }
        
       
    }
}
