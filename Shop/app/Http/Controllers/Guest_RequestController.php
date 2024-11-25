<?php

namespace App\Http\Controllers;

use App\Models\Guest_Request;
use App\Models\RequestType;
use Illuminate\Http\Request;

class Guest_RequestController extends Controller
{

    public function index(Request $request){

        $perPage = $request->input('perPage', 1);
        $search_string = $request->input('search_string');
        $typeFilter = $request->input('typeFilter');
       
        $requestTypes = RequestType::all();
        $guestRequests = Guest_Request::query();

        if ($typeFilter !== null) {
            $guestRequests->where('request_id', $typeFilter);
        }

        if($search_string !== null){
            $guestRequests->where('fullname','like','%'. $search_string.'%');
        }
      
        $guestRequests = $guestRequests->paginate($perPage);
            
            if ($request->ajax()) {
                
                return view('Admin.Requests.guestrequests', compact('guestRequests', 'requestTypes'))->render();
            }

        return view('Admin.Requests.guestrequests', [
            'guestRequests' => $guestRequests,
            'requestTypes' => $requestTypes,
          
        ])->render();
    }

    public function show_edit($id){
        $guestRequest = Guest_Request::where('id', $id)->first();
       
        return view('Admin.Requests.guestrequests_edit',[
            'guestRequest' => $guestRequest,
            
        ]);
    }

    public function delete($id){
        Guest_Request::where('id', $id)->delete();

        $request = new Request();
        $response = $this->index($request);

        return $response;
      
    }

    public function store(Request $request){
        $requestInfo = $request->all();

        $newRequest = new Guest_Request([
            'request_id' => $requestInfo['request_id'],
            'request_status' => 1,
            'fullname' => $requestInfo['fullname'],
            'country' => $requestInfo['country'],
            'town' => $requestInfo['town'],
            'phone' => $requestInfo['phone'],
            'email' => $requestInfo['email'],
            'details' => $requestInfo['details'],

        ]);

        $newRequest->save();
    }
}
