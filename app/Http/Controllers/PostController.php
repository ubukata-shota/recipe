<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Week;
use App\Models\Category;
use App\Models\Ingredient;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post, Category $category)
    {
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit()], ['category' => $category]);
    }
    
    public function show(Post $post, Category $category)
    {
        $ingredients = Ingredient::all();
        return view('posts.show')->with(['post' => $post, 'category' => $category, 'ingredients' => $ingredients]);
    }
    
    public function create(Post $post)
    {
        $category = Category::all();
        return view('posts.create')->with(['post' => $post, 'categories' => $category]);
    }
    
    public function store(PostRequest $request, Post $post, Week $week, Category $category, Ingredient $ingredient)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        
        $input_category = $request['category'];
        $post->category()->associate($input_category);
        $post->save();
        
        //材料追加機能　途中
        $input_ingredients = $request->input('ingredient');

        foreach ($input_ingredients as $input_ingredient) {
            $new_ingredient = new Ingredient();
            $new_ingredient->fill($input_ingredient);
            $new_ingredient->save();
            $new_ingredient->post()->associate($post);
            $new_ingredient->save();
        }//以上
        
        $input_date = $request['week'];
        $week->fill($input_date)->save();
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
        $ingredient = Ingredient::all();
        $category = Category::all();
        return view('posts.edit')->with(['post' => $post, 'categories' => $category, 'week' => $week, 'ingredients' => $ingredient]);
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
        //材料の変更　（途中）
        // 既存の材料データを削除する
        $deletedRows = Ingredient::where('post_id', $post->id)->delete();

        // 新しい材料データを再登録する
        foreach ($request->input('ingredient', []) as $index => $ingredientData) {
            $ingredient = new Ingredient();
            $ingredient->name = $ingredientData['name'];
            $ingredient->post_id = $post->id;
            $ingredient->save();
        }
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
