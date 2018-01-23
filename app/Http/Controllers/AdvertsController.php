<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Advert;
use App\Category;
use App\Location;
use DateTime;
use DateInterval;
use Input;

class AdvertsController extends Controller
{

    public function byID($adv)
    {
        $categories = DB::table('categories')->find($adv);
        return view('home', compact('adv','categories'));
    }


    public function index()
    {
        $categories = DB::table('categories')->get();
        $ads = DB::table('adverts')->orderBy('category_id', 'created_at')->limit(10)->get();
        $locations = DB::table('locations')->get();

        return view('home', compact('ads', 'categories', 'locations'));
    }

    public function adverts(Category $category = null, Location $location = null)
    {
        $categories = DB::table('categories')->get();
        $locations = DB::table('locations')->get();
        $hasCategory = false;
        $ads = DB::table('adverts')->orderBy('category_id', 'created_at')->paginate(10);

        return view('adverts', compact('ads', 'categories', 'locations', 'hasCategory'));
    }

    public function byCategoryLocation(Category $category, Location $location)
    {
        $categories = DB::table('categories')->get();
        $locations = DB::table('locations')->get();
        $ads = DB::table('adverts')->where([['location_id', '=', $location->id],['category_id', '=', $category->id]])->paginate(10);
        $hasCategory = $category->name;

        return view('adverts', compact('ads', 'categories', 'locations', 'hasCategory'));

    }

    public function byCategory(Category $category)
    {
        $categories = DB::table('categories')->get();
        $locations = DB::table('locations')->get();
        $ads = DB::table('adverts')->where('category_id', '=', $category->id)->paginate(10);
        $hasCategory = $category->name;

        return view('adverts', compact('ads', 'categories', 'locations','hasCategory'));
    }

    public function byLocation(Location $location)
    {
        $categories = DB::table('categories')->get();
        $locations = DB::table('locations')->get();
        $ads = DB::table('adverts')->where([['location_id', '=', $location->id]])->paginate(10);
        $hasCategory = false;

        return view('adverts', compact('ads', 'categories', 'locations', 'hasCategory'));
    }

    public function new()
    {
        $categories = DB::table('categories')->get();
        $locations = DB::table('locations')->get();

        return view('advertisment.add', compact('categories', 'locations'));
    }

    public function insert(Request $request)
    {
        $path = $request->image->store('image','images');

        $date = new DateTime();
        $date->add(new DateInterval('P30D'));
        $date = $date->format('Y-m-d h:m:s');

        Advert::create([
            'user_id' => '1',
            'category_id' => request('category'),
            'location_id' => request('location'),
            'title' => request('title'),
            'body' => request('body'),
            'image' => 'storage/'.$path,
            'price' => request('price'),
            'expires_on' => $date
        ]);

        return redirect('/home');
    }

}
