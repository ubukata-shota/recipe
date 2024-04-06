<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Week;
use App\Models\Category;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post, Category $category)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()], ['category' => $category]);
    }
    
    public function show(Post $post, Category $category)
    {
        
        return view('posts.show')->with(['post' => $post, 'category' => $category]);
    }
    
    public function create(Post $post)
    {
        $category = Category::all();
        return view('posts.create')->with(['post' => $post, 'categories' => $category]);
    }
    
    public function store(PostRequest $request, Post $post, Week $week, Category $category)
    {
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
    
    public function week()
    {
        $post = Post::all();
        $week = Week::all();
        return view('posts.week')->with(['posts' => $post, 'weeks' => $week]);
    }
    
    public function edit(Post $post, Week $week)
    {
        $category = Category::all();
        return view('posts.edit')->with(['post' => $post, 'categories' => $category, 'week' => $week]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        //投稿内容の編集
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        //カテゴリーの編集
        $input_category = $request['category'];
        $post->category()->associate($input_category);
        $post->save();
        //日付の変更
        $week = Week::where('post_id', $post->id)->first();
        $input_date = $request->input('week');
        $week->date = $input_date['date'];
        $week->save();
        
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    
    
}
