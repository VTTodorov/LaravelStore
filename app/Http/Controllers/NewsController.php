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
        return view('news.add');
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    // Insert into Database
    public function insert(Request $request)
    {
        $validator = $this->validateNews($request);

        if($validator->fails()){
            return redirect('new/news')
                       ->withErrors($validator)
                       ->withInput();
        }

        $path = $request->image->store('image','images');

        $news = new News;

        $news->title = $request->title;
        $news->body  = $request->body;
        $news->image = 'storage/'.$path;

        $news->save();

        return redirect('/news/'.$request->id);
    }

    // Edit
    public function update(Request $request)
    {
        $validator = $this->validateNewsEdit($request);

        if($validator->fails()){
            return redirect('/news/'.$request->news.'/edit')
                       ->withErrors($validator)
                       ->withInput();
        }

        $news = News::find($request->news);
        $news->title = $request->title;
        $news->body  = $request->body;

        if($request->image){
            $news->image = 'storage/'.$path;
        }

        $news->save();

        return redirect('/news/'.$request->news);
    }

    function validateNewsEdit(Request $request)
    {
        return \Validator::make($request->all(),[
            "title" => "required|min:3|max:30",
            "body" =>"required|min:60|max:500",
            "image" =>"image|max:10240"
        ]);
    }

    function validateNews(Request $request)
    {
        return \Validator::make($request->all(),[
            "title" => "required|min:3|max:30",
            "body" =>"required|min:60|max:500",
            "image" =>"required|image|max:10240"
        ]);
    }
}
