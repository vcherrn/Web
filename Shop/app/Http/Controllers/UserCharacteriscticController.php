<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCharacteriscticStoreRequest;
use App\Http\Requests\UserCharacteriscticUpdateRequest;
use App\Models\UserCharacterisctic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Characteristic;
use Illuminate\Support\Facades\Auth;
class UserCharacteriscticController extends Controller
{
    public function index(Request $request)
    {
        $characteristics = DB::table('characteristics')
            ->join('user_characterisctics', 'characteristics.id', '=', 'user_characterisctics.characteristic_id')
            ->where('user_characterisctics.user_id', '=', Auth::id())
            ->first();

        return $characteristics;
    }

    public function store(Request $request)
    {
        $characteristic = $request->all();
        
        $oldCharacterictic = UserCharacterisctic::where('user_id',Auth::id())->first();
       
        if($oldCharacterictic == null){
            $newcharacteristic = new Characteristic([
                'weight' => $characteristic['weight'],
                'height' => $characteristic['height'],
                'age' => $characteristic['age'],
                'details' => $characteristic['details'],
            ]);
        
            $newcharacteristic->save();

            $newUserCharacterisctic = new UserCharacterisctic([
                'user_id' => Auth::id(),
                'characteristic_id' => $newcharacteristic->id,
            ]);

            $newUserCharacterisctic->save();

        }
        else{
           
            UserCharacterisctic::where('user_id',Auth::id())->delete();
            Characteristic::where('id', $oldCharacterictic['characteristic_id'] )->delete();
            
            
            $newcharacteristic = new Characteristic([
                'weight' => $characteristic['weight'],
                'height' => $characteristic['height'],
                'age' => $characteristic['age'],
                'details' => $characteristic['details'],
            ]);
        
            $newcharacteristic->save();

            $newUserCharacterisctic = new UserCharacterisctic([
                'user_id' => Auth::id(),
                'characteristic_id' => $newcharacteristic->id,
            ]);

            $newUserCharacterisctic->save();
        }

        
    }

}
