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
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param type var Description
     * @return return type
     */
    public function byID($id)
    {
        $adv = DB::table('adverts')->where('id', '=', $id)->first();
        $pictures = DB::table('pictures')->where('add_id', '=', $id)->get();
        return view('advertisment.view', compact('adv','pictures'));
    }

    public function edit($id)
    {
        $categories = DB::table('categories')->get();
        $locations = DB::table('locations')->get();
        $adv = DB::table('adverts')->where('id', '=', $id)->first();
        $pictures = DB::table('pictures')->where('add_id', '=', $id)->get();
        return view('advertisment.edit', compact('adv','categories','locations','pictures'));
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param type var Description
     * @return return type
     */

    public function index()
    {
        $categories = DB::table('categories')->get();
        $ads = DB::table('adverts')->orderBy('created_at', 'desc')->limit(10)->get();
        $locations = DB::table('locations')->get();

        return view('home', compact('ads', 'categories', 'locations'));
    }


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param type var Description
     * @return return type
     */
    public function adverts()
    {
        $categories = DB::table('categories')->get();
        $locations = DB::table('locations')->get();
        $hasCategory = false;
        $ads = DB::table('adverts')->orderBy('created_at', 'desc')->paginate(10);

        return view('adverts', compact('ads', 'categories', 'locations', 'hasCategory'));
    }


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param type var Description
     * @return return type
     */
    public function byCategoryLocation(Category $category, Location $location)
    {
        $categories = DB::table('categories')->get();
        $locations = DB::table('locations')->get();
        $ads = DB::table('adverts')->where([['location_id', '=', $location->id],['category_id', '=', $category->id]])->paginate(10);
        $hasCategory = $category->name;

        return view('adverts', compact('ads', 'categories', 'locations', 'hasCategory'));

    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param type var Description
     * @return return type
     */
    public function byCategory(Category $category)
    {
        $categories = DB::table('categories')->get();
        $locations = DB::table('locations')->get();
        $ads = DB::table('adverts')->where('category_id', '=', $category->id)->paginate(10);
        $hasCategory = $category->name;

        return view('adverts', compact('ads', 'categories', 'locations','hasCategory'));
    }


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param type var Description
     * @return return type
     */
    public function byLocation(Location $location)
    {
        $categories = DB::table('categories')->get();
        $locations = DB::table('locations')->get();
        $ads = DB::table('adverts')->where([['location_id', '=', $location->id]])->paginate(10);
        $hasCategory = false;

        return view('adverts', compact('ads', 'categories', 'locations', 'hasCategory'));
    }


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param type var Description
     * @return return type
     */
    public function new()
    {
        $categories = DB::table('categories')->get();
        $locations = DB::table('locations')->get();

        return view('advertisment.add', compact('categories', 'locations'));
    }


    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param type var Description
     * @return return type
     */
    public function insert(Request $request)
    {
        //validations
        $validator = \Validator::make($request->all(), [
            'pictures' => 'required|image|size:10240',
        ]);

        $request->validate([
            "title" => "required|min:3|max:30",
            "body" =>"required|min:60|max:255",
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
        $advert->body        = $request->body;
        $advert->image       = 'storage/'.$path;
        $advert->price       = $request->price;
        $advert->expires_on  = $date;

        $advert->save();

        foreach ($request->images as $key => $image) {
            $pic = new Picture;

            $pic->add_id = $advert->id;
            $pic->image = 'storage/'.$image->store('image','images');

            $pic->save();
        }

        return redirect('/home');
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param type var Description
     * @return return type
     */
    public function change(Request $request)
    {
        dd($request->id);
        $path = $request->image->store('image','images');


        Advert::create([
            'user_id' => '1',
            'category_id' => request('category'),
            'location_id' => request('location'),
            'title' => request('title'),
            'body' => request('body'),
            'image' => 'storage/'.$path,
            'price' => request('price'),
        ]);

        return redirect('/home');
    }

}
