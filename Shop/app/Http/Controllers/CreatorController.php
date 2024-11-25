<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatorStoreRequest;
use App\Http\Requests\CreatorUpdateRequest;
use App\Models\Creator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
class CreatorController extends Controller
{

    public function show_current_creator($id){

        $creator = Creator::where('id',$id)->get(); 
        // $creator = DB::statement('CALL get_current_creator(?)', [$id]);
        return $creator;
    }
    
    public function creators_show(){
        $creators = Creator::all(); 
        
        
        return view('Admin.Settings.creators', [
            'creators'=>$creators,
            
        ]);
    }

    public function creator_edit_show($id){
        $creator = Creator::where('id',$id)->get(); 
       
       
        return view('Admin.Settings.creator_edit', [
            'creator'=>$creator,
            
        ]);
    }

    public function creator_update($id, Request $request){
        // $creator = Creator::find($id);
        // $creator->update([
        //     'name' => $request->input('c_name'),
        //     'country' => $request->input('c_country'),
        //     'description' => $request->input('c_description'),
           
            
        // ]);

        // $creator->fresh();
        DB::statement('CALL update_current_creator(?, ?, ?, ?)', [$id, $request->input('c_name'), 
                                                        $request->input('c_country'), $request->input('c_description')]);
       
        return redirect()->back();
        
    }

    public function creator_create(Request $request){
        
        return view('Admin.Settings.creator_create', []);
        
    }

    public function creator_store(Request $request){
        // $creator = new Creator;

        // $creator->name = $request->input('c_name');
        // $creator->country = $request->input('c_country');
        // $creator->description = $request->input('c_description');


        // $creator->save();
        DB::statement('CALL create_new_creator( ?, ?, ?)', [$request->input('c_name'), 
                                                        $request->input('c_country'), $request->input('c_description')]);
        return redirect()->route('creators.show');
        
    }

    public function delete($id){
        
        // Creator::where('id', $id)->delete();
        DB::statement('CALL delete_creator(?)', [$id]);
        return redirect()->back();
        
    }
}
