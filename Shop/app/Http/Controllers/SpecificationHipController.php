<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecificationHipStoreRequest;
use App\Http\Requests\SpecificationHipUpdateRequest;
use App\Models\SpecificationHip;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Prosthes;
class SpecificationHipController extends Controller
{
    public function store(Request $request)
    {   
       
        $specification = new SpecificationHip;

        $specification->category_id = 4;
        $specification->product_type = $request->input('type');
        $specification->activity_level = $request->input('activity_level');
        $specification->max_weight = $request->input('max_w');
        $specification->weight = $request->input('weight');
        $specification->distal_part_connection = $request->input('distal_part_connection');
        $specification->proximal_part_connection = $request->input('proximal_part_connection');
        $specification->t_angle = $request->input('t_angle');
        $specification->system_height = $request->input('system_height');
        $specification->montage_height = $request->input('montage_height');
        $specification->type_of_side = $request->input('sides');
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

        $specification = SpecificationHip::where('category_id',4)->where('id', $prosthes->specifiable_id)->first();
        if($specification){
            $specification->update([
                'category_id' => $request->input('cat_id'),
                'product_type' => $request->input('type'),
                'activity_level' => $request->input('activity_level'),
                'max_weight' => $request->input('max_w'),
                'weight' => $request->input('weight'),
                'distal_part_connection' => $request->input('distal_part_connection'),
                'proximal_part_connection' => $request->input('proximal_part_connection'),
                't_angle' => $request->input('t_angle'),
                'system_height' => $request->input('system_height'),
                'montage_height' => $request->input('montage_height'),
                'type_of_side' => $request->input('sides'),
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
