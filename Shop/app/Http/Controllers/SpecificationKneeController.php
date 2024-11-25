<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecificationKneeStoreRequest;
use App\Http\Requests\SpecificationKneeUpdateRequest;
use App\Models\SpecificationKnee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Prosthes;
class SpecificationKneeController extends Controller
{
    public function store(Request $request)
    {   
       
        $specification = new SpecificationKnee;

        $specification->category_id = 5;
        $specification->product_type = $request->input('type');
        $specification->amputation_rate = $request->input('amputation_rate');
        $specification->activity_level = $request->input('activity_level');
        $specification->max_weight = $request->input('max_w');
        $specification->weight = $request->input('weight');
        $specification->distal_part_connection = $request->input('distal_part_connection');
        $specification->proximal_part_connection = $request->input('proximal_part_connection');
        $specification->knee_angle = $request->input('knee_angle');
        $specification->system_height_prox = $request->input('sys_height_prox');
        $specification->min_system_height_dist = $request->input('min_system_height_dist');
        $specification->max_system_height_dist = $request->input('max_system_height_dist');
        $specification->min_montage_height = $request->input('min_montage_height');
        $specification->max_montage_height = $request->input('max_montage_height');
        $specification->proximal_montage_height = $request->input('proximal_montage_height');
        $specification->min_dist_montage_height = $request->input('min_dist_montage_height');
        $specification->max_dist_montage_height = $request->input('max_dist_montage_height');
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

        $specification = SpecificationKnee::where('category_id',5)->where('id', $prosthes->specifiable_id)->first();
        if($specification){
            $specification->update([
                'category_id' => $request->input('cat_id'),
                'product_type' => $request->input('type'),
                'amputation_rate' => $request->input('amputation_rate'),
                'activity_level' => $request->input('activity_level'),
                'max_weight' => $request->input('max_w'),
                'weight' => $request->input('weight'),
                'distal_part_connection' => $request->input('distal_part_connection'),
                'proximal_part_connection' => $request->input('proximal_part_connection'),
                'knee_angle' => $request->input('knee_angle'),
                'system_height_prox' => $request->input('sys_height_prox'),
                'min_system_height_dist' => $request->input('min_system_height_dist'),
                'max_system_height_dist' => $request->input('max_system_height_dist'),
                'min_montage_height' => $request->input('min_montage_height'),
                'max_montage_height' => $request->input('max_montage_height'),
                'proximal_montage_height' => $request->input('proximal_montage_height'),
                'min_dist_montage_height' => $request->input('min_dist_montage_height'),
                'max_dist_montage_height' => $request->input('max_dist_montage_height'),
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
