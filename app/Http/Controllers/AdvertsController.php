<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Advert;
use App\Category;
use App\Location;
use App\Picture;
use DateTime;
use DateInterval;
use Input;

class AdvertsController extends Controller
{
    /**
     * Preview one advert
     *
     * @param Advert $adv
     */
    public function byID(Advert $adv)
    {
        $pictures = Picture::where('add_id', $adv->id)->get();
        return view('advertisment.view', compact('adv','pictures'));
    }

    /**
     * Edit advert
     *
     * @param Advert $adv
     */
    public function edit(Advert $adv)
    {
        $categories = Category::get();
        $locations = Location::get();
        $pictures = Picture::where('add_id', $adv->id)->get();
        return view('advertisment.edit', compact('adv','categories','locations','pictures'));
    }

    /**
     * Shows home page
     *
     */
    public function index()
    {
        $categories = Category::get();
        $ads = Advert::orderBy('created_at', 'desc')->limit(10)->get();
        $locations = Location::get();

        return view('home', compact('ads', 'categories', 'locations'));
    }


    /**
     * Shows adverts page
     *
     */
    public function adverts()
    {
        $categories = Category::get();
        $locations = Location::get();
        $hasCategory = false;
        $ads = Advert::orderBy('created_at', 'desc')->paginate(10);

        return view('adverts', compact('ads', 'categories', 'locations', 'hasCategory'));
    }


    /**
     * Shows adverts filtered by locationd and category
     *
     * @param Description $description
     * @param Category $category
     */
    public function byCategoryLocation(Category $category, Location $location)
    {
        $categories = Category::get();
        $locations = Location::get();
        $ads = Advert::where([['location_id', '=', $location->id],['category_id', '=', $category->id]])->paginate(10);
        $hasCategory = $category->name;

        return view('adverts', compact('ads', 'categories', 'locations', 'hasCategory'));

    }

    /**
     * Shows adverts filtered by category
     *
     * @param Category $category
     */
    public function byCategory(Category $category)
    {
        $categories = Category::get();
        $locations = Location::get();
        $ads = Advert::where('category_id', '=', $category->id)->paginate(10);
        $hasCategory = $category->name;

        return view('adverts', compact('ads', 'categories', 'locations','hasCategory'));
    }


    /**
     * Shows adverts filtered by location
     *
     * @param Location $location
     */
    public function byLocation(Location $location)
    {
        $categories = Category::get();
        $locations = Location::get();
        $ads = Advert::where([['location_id', '=', $location->id]])->paginate(10);
        $hasCategory = false;

        return view('adverts', compact('ads', 'categories', 'locations', 'hasCategory'));
    }


    /**
     * Shows create new advert page
     *
     */
    public function new()
    {
        $categories = Category::get();
        $locations = Location::get();

        return view('advertisment.add', compact('categories', 'locations'));
    }


    /**
     * Creates new advert
     *
     * @param Request $request
     */
    public function insert(Request $request)
    {
        //validations
        $validator = \Validator::make($request->all(), [
            'pictures' => 'required|image|size:10240',
        ]);

        $request->validate([
            "title" => "required|min:3|max:30",
            "ckbody" =>"required|min:60|max:255",
            "image" =>"required|max:10240",
            "price" => "required|numeric",
        ]);

        $path = $request->image->store('image','images');


        $date = new DateTime();
        $date->add(new DateInterval('P30D'));
        $date = $date->format('Y-m-d h:m:s');

        $advert = new Advert;

        $advert->user_id = 1;
        $advert->category_id = $request->category;
        $advert->location_id = $request->location;
        $advert->title       = $request->title;
        $advert->body        = $request->ckbody;
        $advert->image       = 'storage/'.$path;
        $advert->price       = $request->price;
        $advert->expires_on  = $date;

        $advert->save();


        // Add new images
        foreach ($request->images as $key => $image) {
            $pic = new Picture;

            $pic->add_id = $advert->id;
            $pic->image = 'storage/'.$image->store('image','images');

            $pic->save();
        }

        return redirect('/home');
    }

    /**
     * Edits existing advert
     *
     * @param Request $request
     */
    public function change(Request $request)
    {
        $adv = Advert::find($request->id);

        $adv->title       = $request->name;
        $adv->body        = $request->ckbody;
        $adv->price       = $request->price;
        $adv->category_id = $request->category;
        $adv->location_id = $request->location;

        // Check if profile picture has changed
        if($request->image){
            $adv->image   = 'storage/'.$request->image->store('image', 'images');
        }

        // Check for deleted images
        foreach ($request->images as $id) {
            if($id){
                $pic = Picture::find($id);
                $pic->delete();
            }
        }

        // Add new images
        if ($request->new_images) {
            foreach ($request->new_images as $key => $image) {
                $pic = new Picture;
                $pic->add_id = $adv->id;
                $pic->image = 'storage/'.$image->store('image','images');
                $pic->save();
            }
        }

        $adv->save();

        return redirect('/adv/'.$request->id);
    }

}
