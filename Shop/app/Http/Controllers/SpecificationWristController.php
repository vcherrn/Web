<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecificationWristStoreRequest;
use App\Http\Requests\SpecificationWristUpdateRequest;
use App\Models\SpecificationWrist;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Prosthes;
class SpecificationWristController extends Controller
{
    public function store(Request $request)
    {   
       
        $specification = new SpecificationWrist;

        $specification->category_id = 3;
        $specification->product_type = $request->input('type');
        $specification->type_of_side = $request->input('sides');
        $specification->arm_size = $request->input('arm_size');
        $specification->voltage = $request->input('voltage');
        $specification->temperature = $request->input('tempreture');
        $specification->opening_width = $request->input('opening_width');
        $specification->gripping_power = $request->input('gripping_power');
        $specification->gripping_speed = $request->input('gripping_speed');
        $specification->weight = $request->input('weight');
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

        $specification = SpecificationWrist::where('category_id',3)->where('id', $prosthes->specifiable_id)->first();
        if($specification){
            $specification->update([
                'category_id' => $request->input('cat_id'),
                'product_type' => $request->input('type'),
                'type_of_side' => $request->input('sides'),
                'arm_size' => $request->input('arm_size'),
                'voltage' => $request->input('voltage'),
                'temperature' => $request->input('tempreture'),
                'opening_width' => $request->input('opening_width'),
                'gripping_power' => $request->input('gripping_power'),
                'gripping_speed' => $request->input('gripping_speed'),
                'weight' => $request->input('weight'),
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
