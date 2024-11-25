<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\ActiveRequestStoreRequest;
use App\Http\Requests\ActiveRequestUpdateRequest;
use App\Models\ActiveRequest;
use App\Models\RequestType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ActiveRequestController extends Controller
{
    
    public function index(Request $request){

        $perPage = $request->input('perPage', 5);
        $search_string = $request->input('search_string');
        $typeFilter = $request->input('typeFilter');
        $statusFilter =  $request->input('statusFilter');
        $users = User::all();
        $requestTypes = RequestType::all();
        $activeRequests = ActiveRequest::query();

        if ($typeFilter !== null) {
            $activeRequests->where('request_id', $typeFilter);
        }

        if ($statusFilter !== null) {
            $activeRequests->where('request_status', $statusFilter);
        }

        if($search_string !== null){
            $activeRequests->where('id', (int)$search_string);
        }
      
        $activeRequests = $activeRequests->paginate($perPage);
            
            if ($request->ajax()) {
                
                return view('Admin.Requests.usersrequests', compact('activeRequests', 'users', 'requestTypes'))->render();
            }

        return view('Admin.Requests.usersrequests', [
            'activeRequests' => $activeRequests,
            'users' => $users,
            'requestTypes' => $requestTypes,
          
        ])->render();
    }

    public function show_edit($id, Request $request){
        $activeRequest = ActiveRequest::where('id', $id)->first();
        $user_characteristics = DB::select('CALL show_user_characteristics_join()');
        // DB::table('characteristics')
        //     ->join('user_characterisctics', 'characteristics.id', '=', 'user_characterisctics.characteristic_id')
        //     ->join('users', 'user_characterisctics.user_id', '=', 'users.id')
        //     ->get();
          
        
        return view('Admin.Requests.usersrequests_edit',[
            'order' => $activeRequest,
            'user_characteristics' => $user_characteristics,
        ]);
    }

    public function delete($id){
        // $activeRequest = ActiveRequest::where('id', $id)->first();

        DB::statement('CALL disable_active_client_request(?)', [$id]);
        // $activeRequest->update([
        //     'request_status' =>0,
        // ]);
        // $activeRequest->fresh();

        return redirect()->back();
    }

    public function store(Request $request){
        $requestInfo = $request->all();

        $newRequest = new ActiveRequest([
            'user_id' => Auth::id(),
            'request_id' => $requestInfo['request_id'],
            'request_status' => 1,
            'name' => $requestInfo['name'],
            'surname' => $requestInfo['surname'],
            'patronymic' => $requestInfo['patronymic'],
            'country' => $requestInfo['country'],
            'town' => $requestInfo['town'],
            'telephone_number' => $requestInfo['telephone_number'],
            'user_email' => $requestInfo['email'],
            'message_text' => $requestInfo['message_text'],

        ]);

        $newRequest->save();
    }
}
