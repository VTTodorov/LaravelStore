<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Advert;
use App\Category;
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


    public function index(Category $category = null)
    {
        $categories = DB::table('categories')->get();

        if($category == null)
        {
            $ads = DB::table('adverts')->orderBy('category_id', 'created_at')->paginate(10);
        }
        else
        {
            $ads = DB::table('adverts')->where('category_id', '=', $category->id)->paginate(10);
        }

        return view('home', compact('ads', 'categories'));
    }

    public function new()
    {
        return view('advertisment.add');
    }

    public function insert(Request $request)
    {
        $path = $request->image->store('image','images');

        $date = new DateTime();
        $date->add(new DateInterval('P30D'));
        $date = $date->format('Y-m-d h:m:s');
        Advert::create([
            'user_id' => '1',
            'category_id' => '1',
            'title' => request('title'),
            'body' => 'test body',
            'image' => $path,
            'price' => '100',
            'expires_on' => $date
        ]);

        return redirect('/home');
    }

}
