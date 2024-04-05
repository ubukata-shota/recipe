<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Week;
use App\Models\Category;

class PostController extends Controller
{
    public function index(Post $post, Category $category){
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()], ['category' => $category]);
    }
    
    public function show(Post $post, Category $category){
        
        return view('posts.show')->with(['post' => $post, 'category' => $category]);
    }
    
    public function create(){
        $category = Category::all();
        return view('posts.create')->with(['categories' => $category]);
    }
    
    public function store(Request $request, Post $post, Week $week, Category $category){
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        $input_date = $request['week'];
        $week->fill($input_date)->save();
        $input_category = $request['category'];
        $post->category()->associate($input_category);
        $post->save();
        $week->post()->associate($post);
        $week->save();
        $post->user()->associate($user_id = auth()->id());
        $post->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function week(){
        $post = Post::all();
        $week = Week::all();
        return view('posts.week')->with(['posts' => $post, 'weeks' => $week]);
    }
    
}
