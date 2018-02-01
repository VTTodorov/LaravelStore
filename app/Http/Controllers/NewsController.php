<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\News;
use App\Category;
class NewsController extends Controller
{
    // Get all news
    public function news(){
        $news = News::get();
        $categories = Category::get();
        return view('news.all', compact('news','categories'));
    }

    // Get bt ID
    public function byID(News $news){
        $categories = Category::get();
        return view('news.view', compact('news','categories'));
    }

    // Create news
    public function new()
    {
        return view('news.add', compact('categories'));
    }

// Insert into Database
    public function insert(Request $request)
    {
        $request->validate([
            "title" => "required|min:3|max:30",
            "description" =>"required|min:60|max:255",
            "image" =>"required|image|max:10240"
        ]);

        $path = $request->image->store('image','images');

        $news = new News;

        $news->title = $request->title;
        $news->body  = $request->description;
        $news->image = 'storage/'.$path;

        $news->save();

        return redirect('/news/'.$request->id);
    }
}
