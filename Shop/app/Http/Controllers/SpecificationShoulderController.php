<?php

namespace App\Http\Controllers;

use App\Models\SpecificationShoulder;
use Illuminate\Http\Request;
use App\Models\Prosthes;
class SpecificationShoulderController extends Controller
{
    public function store(Request $request)
    {   
       
        $specification = new SpecificationShoulder;

        $specification->category_id = 1;
        $specification->product_type = $request->input('type');
        $specification->type_of_side = $request->input('sides');
        $specification->gripping_power = $request->input('gripping_power');
        $specification->opening_width = $request->input('opening_width');
        $specification->voltage = $request->input('voltage');
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

        $specification = SpecificationShoulder::where('category_id',1)->where('id', $prosthes->specifiable_id)->first();
        if($specification){
            $specification->update([
                'category_id' => $request->input('cat_id'),
                'product_type' => $request->input('type'),
                'type_of_side' => $request->input('sides'),
                'gripping_power' => $request->input('gripping_power'),
                'opening_width' => $request->input('opening_width'),
                'voltage' => $request->input('voltage'),
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
