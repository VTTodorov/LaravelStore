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
        return view('advertisment.view', compact('adv'));
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
        $ads = DB::table('adverts')->orderBy('category_id', 'created_at')->limit(10)->get();
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
        $ads = DB::table('adverts')->orderBy('category_id', 'created_at')->paginate(10);

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
