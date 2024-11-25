<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Prosthes;
use App\Models\Creator;
use Illuminate\Support\Facades\DB;
use App\Models\SpecificationFoot;
use App\Models\SpecificationForearm;
use App\Models\SpecificationHip;
use App\Models\SpecificationKnee;
use App\Models\SpecificationShoulder;
use App\Models\SpecificationWrist;
use App\Models\Type;

class CategoryController extends Controller
{
    
    public function showCategories()
    {
        $categories = Category::all();
        
        return $categories;
    }
    public function index($id)
    {
        $prostheses = Prosthes::all();
        $categories = Category::all(); 
        $creators = Creator::all();
        switch ((int)$id) {
            case 1:
                return view('Admin.Specifications.shoulder', [
                    'prostheses'=>$prostheses,
                    'categories'=>$categories,
                    'creators' => $creators
                ]);
                
            case 2:
                return view('Admin.Specifications.forearm', [
                    'prostheses'=>$prostheses,
                    'categories'=>$categories,
                    'creators' => $creators
                ]);
            case 3:
                return view('Admin.Specifications.wrist', [
                    'prostheses'=>$prostheses,
                    'categories'=>$categories,
                    'creators' => $creators
                ]);
            case 4:
                return view('Admin.Specifications.hip', [
                    'prostheses'=>$prostheses,
                    'categories'=>$categories,
                    'creators' => $creators
                ]);
           case 5:
            return view('Admin.Specifications.knee', [
                'prostheses'=>$prostheses,
                'categories'=>$categories,
                'creators' => $creators
            ]);
            case 6:
                return view('Admin.Specifications.foot', [
                    'prostheses'=>$prostheses,
                    'categories'=>$categories,
                    'creators' => $creators
                ]);

            default:
                break;
        }
       
    }

    public function show_category_for_update($cat_id, Prosthes $prosthes)
    {
        
        $categories = Category::all(); 
        $creators = Creator::all();
        switch ((int)$cat_id) {
            case 1:
                $specification = SpecificationShoulder::where('id', $prosthes->specifiable_id)->where('category_id', $prosthes->category_id)->get();
                return view('Admin.UpdSpecifications.shoulder', [
                    'prosthes'=>$prosthes,
                    'categories'=>$categories,
                    'specification'=>$specification,
                    'creators' => $creators
                ]);
                
            case 2:
                $specification = SpecificationForearm::where('id', $prosthes->specifiable_id)->where('category_id', $prosthes->category_id)->get();
                return view('Admin.UpdSpecifications.forearm', [
                    'prosthes'=>$prosthes,
                    'categories'=>$categories,
                    'specification'=>$specification,
                    'creators' => $creators
                ]);
            case 3:
                $specification = SpecificationWrist::where('id', $prosthes->specifiable_id)->where('category_id', $prosthes->category_id)->get();
                return view('Admin.UpdSpecifications.wrist', [
                    'prosthes'=>$prosthes,
                    'categories'=>$categories,
                    'specification'=>$specification,
                    'creators' => $creators
                ]);
            case 4:
                $specification = SpecificationHip::where('id', $prosthes->specifiable_id)->where('category_id', $prosthes->category_id)->get();
                return view('Admin.UpdSpecifications.hip', [
                    'prosthes'=>$prosthes,
                    'categories'=>$categories,
                    'specification'=>$specification,
                    'creators' => $creators
                ]);
           case 5:
                $specification = SpecificationKnee::where('id', $prosthes->specifiable_id)->where('category_id', $prosthes->category_id)->get();
                return view('Admin.UpdSpecifications.knee', [
                    'prosthes'=>$prosthes,
                    'categories'=>$categories,
                    'specification'=>$specification,
                    'creators' => $creators
            ]);
            case 6:
                $specification = SpecificationFoot::where('id', $prosthes->specifiable_id)->where('category_id', $prosthes->category_id)->get();
                return view('Admin.UpdSpecifications.foot', [
                    'prosthes'=>$prosthes,
                    'categories'=>$categories,
                    'specification'=>$specification,
                    'creators' => $creators
                ]);

            default:
                break;
        }
       
    }

    public function category_list_show(){
        $categories = Category::all(); 
        $types = Type::all();
        $typeNames = [];
        foreach ($types as $type) {
            $typeNames[$type->id] = $type->name;
        }
        return view('Admin.Settings.categories', [
            'categories'=>$categories,
            'types'=> $typeNames,
        ]);
    }

    public function category_edit($id){
        $category = Category::where('id',$id)->get(); 
        $types = Type::all();
        $typeNames = [];
        foreach ($types as $type) {
            $typeNames[$type->id] = $type->name;
        }
        // dd($typeNames);
        return view('Admin.Settings.category_edit', [
            'category'=>$category,
            'types'=> $types,
        ]);
    }

    public function category_update($id, Request $request){
        
        // $category = Category::find($id);
        // $category->update([
        //     'name' => $request->input('cat_name'),
        //     'type_id' => $request->input('type_id'),
            
        // ]);

        // $category->fresh();
        DB::statement('CALL update_category(?,?,?)', [$id, $request->input('cat_name'), $request->input('type_id') ]);
       
        return redirect()->back()->with('success', 'Категория успешно обновлена');
        
    }

    public function category_create(Request $request){
        
        $types = Type::all();
        $typeNames = [];
        foreach ($types as $type) {
            $typeNames[$type->id] = $type->name;
        }
       
        return view('Admin.Settings.category_create', [
            'types'=> $types,
        ]);
        
    }

    public function category_store(Request $request){
        // $category = new Category;

        // $category->name = $request->input('cat_name');
        // $category->type_id = $request->input('type_id');

        // $category->save();

        DB::statement('CALL create_new_category(?, ?)', [$request->input('cat_name'), $request->input('type_id')]);
        return redirect()->route('categorylist.show');
        
    }

    public function delete($id){
        
        // Category::where('id', $id)->delete();
        DB::statement('CALL delete_category(?)', [$id]);
        return redirect()->back();
        
    }
    
}
