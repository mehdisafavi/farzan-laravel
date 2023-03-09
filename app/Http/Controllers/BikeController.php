<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\BikeColor;
use App\Models\BikeModel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class BikeController extends Controller
{
    /**
     * Display the Bikes list
     */
    public function index (Request $request): View
    {
        $bikes = Bike::orderBy('created_at','desc')->get();
        $colors = BikeColor::all();
        $models = BikeModel::all();
        return view('bike.bikes', [
            'user' => $request->user(),
            'bikes' => $bikes,
            'colors' => $colors,
            'models' => $models,
        ]);
    }

    /**
     * Display the Bikes list in main page
     */
    public function main (Request $request): View
    {

        $filter = (int)$request->filter ;
        $sort =  $request->sort ;


        $bikes = New Bike;

        if($filter > 0)
        {

           // $request->instance()->query->set('page', 1);
            $bikes = $bikes->where('color_id',$filter);
        }



        if($sort !='')
        {

            switch ($sort) {
                case 'p-desc':
                    $bikes= $bikes->orderBy('price','desc');
                    break;
                case 'p-asc':
                   /* $sortedResult = $bikes->getCollection()->sortBy(function ($query) {
                        return $query->bike_model->name;
                    });*/
                    $bikes= $bikes->orderBy('price','asc');
                    break;
                case 'd-desc':
                    $bikes= $bikes->orderBy('created_at','desc');
                    break;
                case 'd-asc':
                    $bikes= $bikes->orderBy('created_at','asc');
                    break;
            }

            //$bikes->setCollection($sortedResult);

        }

        $bikes= $bikes->paginate(5)->withQueryString() ;

        $colors = BikeColor::all();
        $models = BikeModel::all();
        return view('main', [
            'user' => $request->user(),
            'bikes' => $bikes,
            'colors' => $colors,
            'models' => $models,
        ]);
    }

    /**
     * Display a Bike
     */
    public function view (Request $request): View
    {

        $bike_id = (int)$request->bike_id ;

        $bike = Bike::where('id',$bike_id)->first();

        return view('bike.bike', [
            'bike' => $bike,
        ]);
    }

    /**
     * Display the Bikes list
     */
    public function new_bike (Request $request): RedirectResponse
    {
        $bikes = Bike::all();
        $validated = $request->validate([
            'name' => 'required|min:5',
            'model_id' => 'required|numeric',
            'color_id' => 'required|numeric',
            'weight' => 'required|numeric',
            'price' => 'required|numeric',
            'bike_img' => 'required|image|mimes:png,jpg,jpeg'
        ]);

        $imageName = time().'.'.$request->bike_img->extension();

        // Public Folder
        $request->bike_img->move(public_path('bike_images'), $imageName);

        $request->request->add(['bike_image'=>$imageName]);
        Bike::create($request->all());

        return Redirect::route('dashboard.bikes')->with('status', 'stored');
    }
}
