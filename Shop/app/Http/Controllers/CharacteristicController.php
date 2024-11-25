<?php

namespace App\Http\Controllers;

use App\Http\Requests\CharacteristicStoreRequest;
use App\Http\Requests\CharacteristicUpdateRequest;
use App\Models\Characteristic;
use App\Models\UserCharacterisctic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\SpecificationFoot;
use App\Models\SpecificationForearm;
use App\Models\SpecificationHip;
use App\Models\SpecificationKnee;
use App\Models\SpecificationShoulder;
use App\Models\SpecificationWrist;
class CharacteristicController extends Controller
{
    // public function index(Request $request)
    // {
    //     $characteristics = DB::table('characteristics')
    //         ->join('user_characterisctics', 'characteristics.id', '=', 'user_characterisctics.characteristic_id')
    //         ->where('user_characterisctics.user_id', '=', Auth::id())
    //         ->first();


        
    //     return $characteristics;
    // }

    public function getCharacteristics()
    {
        $specifications = collect([]);

        $tables = [
            SpecificationWrist::class,
            SpecificationHip::class,
            SpecificationFoot::class,
            SpecificationKnee::class,
            SpecificationForearm::class,
            SpecificationShoulder::class,
        ];

        foreach ($tables as $table) {
            $specifications = $specifications->concat($table::select('id', 'material', 'product_type')->get());
        }

        $mergedSpecifications = $specifications->map(function ($prosthes) {
            return [
                'table_name' => $prosthes->getTable(),
                'id' => $prosthes->id,
                'material' => $prosthes->material,
                'product_type' => $prosthes->product_type
            ];
        });

        return $mergedSpecifications;
        
    }
    // public function store(Request $request)
    // {
    //     $characteristic = $request->all();
        
    //     $oldCharacterictic = UserCharacterisctic::where('user_id',Auth::id())->first();
       
    //     if($oldCharacterictic == null){
    //         $newcharacteristic = new Characteristic([
    //             'weight' => $characteristic['weight'],
    //             'height' => $characteristic['height'],
    //             'age' => $characteristic['age'],
    //             'details' => $characteristic['details'],
    //         ]);
        
    //         $newcharacteristic->save();

    //         $newUserCharacterisctic = new UserCharacterisctic([
    //             'user_id' => Auth::id(),
    //             'characteristic_id' => $newcharacteristic->id,
    //         ]);

    //         $newUserCharacterisctic->save();

    //     }
    //     else{
           
    //         UserCharacterisctic::where('user_id',Auth::id())->delete();
    //         Characteristic::where('id', $oldCharacterictic['characteristic_id'] )->delete();
            
            
    //         $newcharacteristic = new Characteristic([
    //             'weight' => $characteristic['weight'],
    //             'height' => $characteristic['height'],
    //             'age' => $characteristic['age'],
    //             'details' => $characteristic['details'],
    //         ]);
        
    //         $newcharacteristic->save();

    //         $newUserCharacterisctic = new UserCharacterisctic([
    //             'user_id' => Auth::id(),
    //             'characteristic_id' => $newcharacteristic->id,
    //         ]);

    //         $newUserCharacterisctic->save();
    //     }

        
    // }


   
}
