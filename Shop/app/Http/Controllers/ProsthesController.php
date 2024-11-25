<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProsthesStoreRequest;
use App\Http\Requests\ProsthesUpdateRequest;
use App\Models\Prosthes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\SpecificationFoot;
use App\Models\SpecificationForearm;
use App\Models\SpecificationHip;
use App\Models\SpecificationKnee;
use App\Models\SpecificationShoulder;
use App\Models\SpecificationWrist;
use App\Models\Category;
use App\Models\Log;
use App\Models\Creator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
class ProsthesController extends Controller
{
    public function index()
    {
        // $prosthes = Prosthes::all();
        $prosthes = Prosthes::where('status', 1)->get();
        return $prosthes;
       
    }

    public function sortByAscending()
    {
        $prosthes = Prosthes::orderBy('price', 'asc')->get();
        return $prosthes;
    }
    public function sortByDescending()
    {
        $prosthes = Prosthes::orderBy('price', 'desc')->get();
        return $prosthes;
    }

    public function load_specifications(){
        $specifications = [];
        
        $specifications[6] = SpecificationFoot::all();
        $specifications[5] = SpecificationKnee::all();
        $specifications[4] = SpecificationHip::all();
        $specifications[3] = SpecificationWrist::all();
        $specifications[2] = SpecificationForearm::all();
        $specifications[1] = SpecificationShoulder::all();

        return $specifications;
    }
    public function show_specification($type,$id)
    {
        
        $specification = null;

        switch ($type) {
            case 'specification_foots':

                $specification = SpecificationFoot::find($id);
                break;
            case 'specification_knees':
                $specification = SpecificationKnee::find($id);
                break;
            case 'specification_forearms':
                $specification = SpecificationForearm::find($id);
                break;
            case 'specification_hips':
                $specification = SpecificationHip::find($id);
                break;
           case 'specification_shoulders':
                $specification = SpecificationShoulder::find($id);
                break;
            case 'specification_wrists':
                $specification = SpecificationWrist::find($id);
                break;

            default:
                break;
        }
        return response()->json($specification);
    }

    public function showFilterCat($id)
    {
        $prostheses = Prosthes::where('category_id', $id)->get();

        return $prostheses;
    }

    public function showFilterTyp($id)
    {
        $categoryIds = Category::where('type_id', $id)->pluck('id');
        $prostheses = Prosthes::whereIn('category_id', $categoryIds)->get();

        return $prostheses;
    }

    //Admin
    public function create() {
        $prostheses = Prosthes::all();
        $categories = Category::all(); 
       
        return view('Admin.Specifications.foot', [
                'prostheses'=>$prostheses,
                'categories'=>$categories,
            ]);
    }

    public function edit(Prosthes $prosthes){
        $categories = Category::all(); 
        $creators = Creator::all();
        return view('Admin.edit',[
            'prosthes' => $prosthes,
            'categories'=>$categories,
            'creators' => $creators
        ]);
    }

    public function update($id, Request $request)
    {   
       
        $specification_id = $request->input('cat_id');
        $specification = [];
        $currentDirectory='';
        switch ($specification_id) {
            case 1:
                $specification_shoulder = new SpecificationShoulderController();
                $specification = $specification_shoulder->update($id, $request);
                break;
            case 2:
                $specification_forearm = new SpecificationForearmController();
                $specification = $specification_forearm->update($id, $request);
                break;
            case 3:
                $specification_wrist = new SpecificationWristController();
                $specification = $specification_wrist->update($id, $request);
                break;
            case 4:
                $specification_hip = new SpecificationHipController();
                $specification = $specification_hip->update($id, $request);
                break;
            case 5:
                $specification_knee = new SpecificationKneeController();
                $specification = $specification_knee->update($id, $request);
                break;
            case 6:
                $specification_foot = new SpecificationFootController();
                $specification = $specification_foot->update($id, $request);
                break;
            default:
                break;
        }
        
        $prosthes = Prosthes::findOrFail($id);
        $oldDirectory = 'photos/prostheses/' . $prosthes->name;
        if ($prosthes->name !== $request->input('name')) {  
            // Создание директории для нового имени
            $currentDirectory = 'photos/prostheses/' . $request->input('name');
            Storage::disk('public')->makeDirectory($currentDirectory);
           
        }
        else{
            $currentDirectory = 'photos/prostheses/' . $prosthes->name;
        }

        $photos = $request->photos;
        $jsonPhotos = [];
        $base64Photos = [];
        $old_photos = [];

        foreach ($photos as $photo) {
            if (strpos($photo, 'data:image') !== false) {
                // Если данные представлены в формате base64
                $base64Photos[] = $photo;
            } else {
                // Если данные представлены в виде относительного пути
                $photoContents = file_get_contents(storage_path('app/public/' . $photo));
                $base64Photo = base64_encode($photoContents);
                $old_photos[] = $base64Photo;
            }
        }
       
         $existingPhotos = json_decode($prosthes->photos, true);
         $prosthesisDirectory = 'photos/prostheses/' . $prosthes->name;
         $existingFiles = File::files(storage_path('app/public/' . $prosthesisDirectory));

        foreach ($existingFiles as $existingFile) {
            $filename = $existingFile->getFilename();
            if (!in_array($filename, $existingPhotos)) {
                Storage::disk('public')->delete($prosthesisDirectory . '/' . $filename);
            }
        }
        
        if($base64Photos){
            foreach ($base64Photos as $photo) {
                    list(, $encodedImage) = explode(';', $photo);
                    list(, $encodedImage) = explode(',', $encodedImage);
                    $decodedImage = base64_decode($encodedImage);
                    // $path = 'photos/prostheses/' . $prosthes->name . '/' . uniqid() . '.jpg';
                    $path = $currentDirectory . '/' . uniqid() . '.jpg';
                    Storage::disk('public')->put($path, $decodedImage);
                    $jsonPhotos[] = $path;
                }
        }
        if ($old_photos){
            foreach ($old_photos as $photo) {
                $encodedImage = $photo;
               
                $decodedImage = base64_decode($encodedImage);
                $path = $currentDirectory . '/' . uniqid() . '.jpg';
                Storage::disk('public')->put($path, $decodedImage);
                $jsonPhotos[] = $path;
            }
        }
    
        $prosthes->update([
            'photos' =>json_encode($jsonPhotos)
        ]);
        $prosthes->fresh();

        $creatorId = $request->input('creator');
    
        $creator = Creator::where('id', $creatorId)->first();
        if ($creator) {
          
            $prosthes->creator_id = $creator->id;
        } 

        $prosthes->update([
            'specifiable_id' => $specification[0],
            'specifiable_type' => $specification[1],
            'category_id' => $request->input('cat_id'),
            'creator_id' => $request->input('creator'),
            'status' => $request->input('status'),
            'article' => $request->input('article'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'year_of_creating' => $request->input('date_cr'),
        ]);

        $prosthes->fresh();
         

        if ($oldDirectory !== $currentDirectory) {
            Storage::disk('public')->deleteDirectory($oldDirectory);
        }
        $log = new Log;
        $log->event = 'Пользователь ' . Auth::id() . ' обновил данные о протезе ' . $prosthes->id;
        $log->created_at = now();
        $log->save();
        return redirect()->route('products.show');
    }

    public function delete(Prosthes $prosthes)
    {   
        $prosthes->update([
            'status' => 0,
        ]);
        $prosthes->fresh();
        $log = new Log;
        $log->event = 'Пользователь ' . Auth::id() . ' снял с наличия протез ' . $prosthes->id;
        $log->created_at = now();
        $log->save();
        return redirect()->route('products.show');
    }

    public function show_all(Request $request){
        $categories = Category::all();
        $perPage = $request->input('perPage', 5);
        $statusFilter = $request->input('statusFilter');
        $search_string = $request->input('search_string');
        $categoryFilter  = $request->input('categoryFilter');

        $prostheses = Prosthes::query();
        $prostheses->orderBy('id','desc');

        if ($statusFilter !== null) {
            $prostheses->where('status', $statusFilter);
        }
        if ($categoryFilter !== null) {
            $prostheses->where('category_id','=',$categoryFilter);
        }
        if($search_string !== null){
            $prostheses->where('name','like','%'. $search_string.'%');
        }

        $prostheses = $prostheses->paginate($perPage);

        if ($request->ajax()) {
                
            return view('Admin.products', compact('prostheses','categories'))->render();
        }

        return view('Admin.products',[
            'prostheses' => $prostheses,
            'categories' => $categories
        ])->render();
    }
    
    
}
