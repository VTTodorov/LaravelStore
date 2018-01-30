<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\News;
use App\Category;
class NewsController extends Controller
{
    //
    public function news(){
        $news = News::get();
        $categories = Category::get();
        return view('news.all', compact('news','categories'));
    }


    public function byID(News $news){
        $categories = Category::get();
        return view('news.view', compact('news','categories'));
    }
}
