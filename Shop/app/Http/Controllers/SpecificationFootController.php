<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecificationFootStoreRequest;
use App\Http\Requests\SpecificationFootUpdateRequest;
use App\Models\Prosthes;
use App\Models\SpecificationFoot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SpecificationFootController extends Controller
{
    

    public function store(Request $request)
    {   
       
        $specification = new SpecificationFoot;

        $specification->category_id = 6;// $request->input('cat_id');
        $specification->product_type = $request->input('type');
        $specification->amputation_rate = $request->input('amputation_rate');
        $specification->activity_level = $request->input('activity_level');
        $specification->max_weight = $request->input('max_w');
        $specification->type_of_side = $request->input('sides');
        $specification->size_of_prosthes = $request->input('size_p');
        $specification->weight = $request->input('weight_p');
        $specification->foot_shape = $request->input('foot_shape');
        $specification->color = $request->input('color');
        $specification->height = $request->input('height_w');
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

        $specification = SpecificationFoot::where('category_id',6)->where('id', $prosthes->specifiable_id)->first();
        if($specification){
            $specification->update([
                'category_id' => $request->input('cat_id'),
                'product_type' => $request->input('type'),
                'amputation_rate' => $request->input('amputation_rate'),
                'activity_level' => $request->input('activity_level'),
                'max_weight' => $request->input('max_w'),
                'type_of_side' => $request->input('sides'),
                'size_of_prosthes' => $request->input('size_p'),
                'weight' => $request->input('weight_p'),
                'foot_shape' => $request->input('foot_shape'),
                'color' => $request->input('color'),
                'height' => $request->input('height_w'),
                'material' => $request->input('material'),
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
