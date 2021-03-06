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
        $ads = Advert::active();
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
        $ads = Advert::active(true);

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
        $ads = Advert::byCategoryLocation($category->id, $location->id);
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
        $ads = Advert::byCategory($category->id);
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
        $ads = Advert::byLocation($location->id);
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
        $validator = $this->validateAdvert($request);

        if ($validator->fails()) {
           return redirect('new/advertisment')
                       ->withErrors($validator)
                       ->withInput();
       }

        $path = $request->image->store('image','images');


        $date = new DateTime();
        $date->add(new DateInterval('P30D'));
        $date = $date->format('Y-m-d h:m:s');

        $advert = new Advert;

        $advert->category_id = $request->category;
        $advert->location_id = $request->location;
        $advert->title       = $request->title;
        $advert->body        = $request->description;
        $advert->image       = 'storage/'.$path;
        $advert->price       = $request->price;
        $advert->expires_on  = $date;

        $advert->save();


        // Add new images
        if($request->images){
            foreach ($request->images as $key => $image) {
                $pic = new Picture;

                $pic->add_id = $advert->id;
                $pic->image = 'storage/'.$image->store('image','images');

                $pic->save();
            }
        }

        return redirect('/home');
    }

    /**
     * Edits existing advert
     *
     * @param Request $request
     */
    public function update(Request $request)
    {
        $validator = $this->validateEdit($request);

        if ($validator->fails()) {
           return redirect('adv/'.$request->id.'/edit')
                       ->withErrors($validator)
                       ->withInput();
        }

        $adv = Advert::find($request->id);

        $adv->title       = $request->title;
        $adv->body        = $request->description;
        $adv->price       = $request->price;
        $adv->category_id = $request->category;
        $adv->location_id = $request->location;

        // Check if profile picture has changed
        if ($request->image) {
            if($request->image){
                $adv->image   = 'storage/'.$request->image->store('image', 'images');
            }
        }

        // Check for deleted images
        if ($request->images) {
            foreach ($request->images as $id) {
                if($id){
                    $pic = Picture::find($id);
                    $pic->delete();
                }
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

    function validateAdvert(Request $request)
    {
        return \Validator::make($request->all(), [
            'images.*' => 'image|max:10240',
            "title" => "required|min:3|max:30",
            "description" =>"required|min:60|max:500",
            "image" =>"required|image|max:10240",
            "price" => "required|numeric",
        ]);
    }

    function validateEdit(Request $request)
    {
        return \Validator::make($request->all(), [
            'new_images.*' => 'image|max:10240',
            "title" => "required|min:3|max:30",
            "description" =>"required|min:60|max:500",
            "image" =>"image|max:10240",
            "price" => "required|numeric",
        ]);
    }

}
