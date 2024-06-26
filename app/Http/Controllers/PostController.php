<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Week;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\BuyList;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Cloudinary;

class PostController extends Controller
{
    public function index(Post $post, Category $category)
    {
        // クライアントインスタンス生成
        $client = new \GuzzleHttp\Client();

        // GET通信するURL
        $url = 'https://teratail.com/api/v1/questions';

        // リクエスト送信と返却データの取得
        // Bearerトークンにアクセストークンを指定して認証を行う
        $response = $client->request(
            'GET',
            $url,
            ['Bearer' => config('services.teratail.token')]
        );
        
        // API通信で取得したデータはjson形式なので
        // PHPファイルに対応した連想配列にデコードする
        $questions = json_decode($response->getBody(), true);
        
        $user = User::all();
        return view('posts.index')->with(['posts' => $post->getPaginateByLimit(), 'category' => $category, 'questions' => $questions['questions'],]);
    }
    
    public function show(Post $post, Category $category)
    {
        $ingredients = Ingredient::all();
        $user = User::all();
        return view('posts.show')->with(['post' => $post, 'category' => $category, 'ingredients' => $ingredients]);
    }
    
    public function create(Post $post)
    {
        $category = Category::all();
        return view('posts.create')->with(['post' => $post, 'categories' => $category]);
    }
    
    public function store(PostRequest $request, Post $post, Week $week, Category $category, Ingredient $ingredient)
    {   
        
        // 画像のパスを取得
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // $img = $image->store('public');
            $img = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            
            $input_post = $request['post'];
            
            // $input_post['image'] = str_replace('public', 'storage', $img);
            $input_post  += ['image' => $img];
            
            $post->fill($input_post)->save();
        } else {
            $post->fill($request['post'])->save();
        }
        
        $input_category = $request['category'];
        $post->category()->associate($input_category);
        $post->save();
        
        $input_ingredients = $request->input('ingredient');
        $input_ingredient_amount = $request->input('ingredient_1');
        $input_ingredient_price = $request->input('ingredient_2');
        $input_ingredient_front_unit = $request->input('ingredient_3');
        $input_ingredient_back_unit = $request->input('ingredient_4');
        
        $input_ingredient_all = [
            'name' => $input_ingredients,
            'front_unit' => $input_ingredient_front_unit,
            'unit_amount' => $input_ingredient_amount,
            'unit_price' => $input_ingredient_price,
            'back_unit' => $input_ingredient_back_unit
        ];
        $input_ingredients = $input_ingredient_all['name'];
        $input_ingredient_front_unit =  $input_ingredient_all['front_unit'];
        $input_ingredient_amount = $input_ingredient_all['unit_amount'];
        $input_ingredient_back_unit =  $input_ingredient_all['back_unit'];
        $input_ingredient_price = $input_ingredient_all['unit_price'];
        if (!empty($input_ingredients) && !empty($input_ingredient_front_unit) && !empty($input_ingredient_amount) && !empty($input_ingredient_back_unit) && !empty($input_ingredient_price)) {
            $ingredientCount = count($input_ingredients);
            for ($i = 1; $i <= $ingredientCount; $i++) {
                $ingredient = new Ingredient();
                $ingredient->name = $input_ingredients[$i]['name'];
                $ingredient->front_unit = $input_ingredient_front_unit[$i]['front_unit'];
                $ingredient->unit_amount = $input_ingredient_amount[$i]['unit_amount'];
                $ingredient->back_unit = $input_ingredient_back_unit[$i]['back_unit'];
                $ingredient->unit_price = $input_ingredient_price[$i]['unit_price'];
                $ingredient->save();
                $ingredient->post()->associate($post);
                $ingredient->save();
            }
        }
        
        $post->user()->associate($user_id = auth()->id());
        $post->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post, Week $week)
    {
        $ingredient = Ingredient::all();
        $category = Category::all();
        
        return view('posts.edit')->with(['post' => $post, 'categories' => $category, 'week' => $week, 'ingredients' => $ingredient]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        // 画像のパスを取得
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // $img = $image->store('public');
            $img = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
            
            $input_post = $request['post'];
            
            // $input_post['image'] = str_replace('public', 'storage', $img);
            $input_post  += ['image' => $img];
            
            $post->fill($input_post)->save();
        } else {
            $post->fill($request['post'])->save();
        }
        
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        //カテゴリーの編集
        $input_category = $request['category'];
        $post->category()->associate($input_category);
        $post->save();
        // 既存の材料データを削除する
        $deletedRows = Ingredient::where('post_id', $post->id)->delete();

        // 新しい材料データを再登録する
        foreach ($request->input('ingredient', []) as $index => $ingredientData) {
            $ingredient = new Ingredient();
            $ingredient->name = $ingredientData['name'];
            $ingredient->unit_amount = $request->input('ingredient_1')[$index]['unit_amount'];
            $ingredient->front_unit = $request->input('ingredient_3')[$index]['front_unit'];
            $ingredient->unit_price = $request->input('ingredient_2')[$index]['unit_price'];
            $ingredient->back_unit = $request->input('ingredient_4')[$index]['back_unit'];
            $ingredient->post_id = $post->id;
            $ingredient->save();
        }
        
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function buy(Post $post)
    {
        $week = Week::all();
        $ingredient = Ingredient::all();
        $buy_list = BuyList::all();
        return view('posts.list')->with(['posts' => $post, 'ingredients' => $ingredient, 'buy_lists' => $buy_list]);
    }
    
    public function makeList(Post $post)
    {
        $week = Week::all();
        $buy_list = BuyList::all();
        return view('posts.makelist')->with(['posts' => $post, 'weeks' => $week]);
    }
    
    public function storelist(Request $request, Post $post)
    {   
        $user_id = Auth::user()->id;
        BuyList::where('user_id', $user_id)->delete();
        
        if ($request->has('buy_list')) {
        $input_buy_list = $request->buy_list;
            foreach ($input_buy_list as $id) {
                $buy_list = new BuyList();
                $buy_list->post_id = $id;
                $user_id = Auth::user()->id;
                $buy_list->user_id = $user_id;
                $buy_list->save();
            }
        }
        return redirect('buy');
    }
    
    public function search(Request $request, Post $post, Category $category)
    {
        $ingredients = Ingredient::all();
        $posts = [];
        
        if ($request->has('post') && $request->post['title'] !== '') {
            $title = $request->post['title'];
            $posts = Post::where('title', 'like', "%$title%")->paginate(7);
        }
        
        return view('posts.search', compact('posts'))->with(['post' => $post, 'category' => $category, 'ingredients' => $ingredients]);
    }
    
    public function menu(Post $post)
    {
        $week = Week::all();
        return view('posts.post_week')->with(['post' => $post, 'week' => $week]);
    }
    
    public function storemenu(Request $request, Post $post, Week $week)
    {
        $input_date = $request['week'];
        $week->fill($input_date)->save();
        $week->post()->associate($post);
        $user_id = Auth::user()->id;
        $week->user_id = $user_id;
        $week->save();
        return redirect('/week');
    }
    
    public function deleteNullUserWeeks()
    {
        Week::whereNull('user_id')->delete();
    }
    
    public function deleteWeek($id)
    {
        Week::destroy($id);
        return redirect('/week');
    }
    
    public function week()
    {
        $post = Post::all();
        $week = Week::all();
        session()->forget('week_count'); // week_count の値を削除
        $week_count = 0;
        return view('posts.week')->with(['week_count'=> $week_count, 'posts' => $post, 'weeks' => $week]);
    }
    
    public function up_week_count()
    {
        $post = Post::all();
        $week = Week::all();
        $week_count = session('week_count', 0) + 7; // セッションから値を取得し、1を加える
        session(['week_count' => $week_count]); // セッションに新しい値を保存
        return view('posts.week')->with(['week_count'=> $week_count, 'posts' => $post, 'weeks' => $week]); // ビューに変数を渡す
    }
    
    public function down_week_count()
    {
        $post = Post::all();
        $week = Week::all();
        $week_count = session('week_count', 0) - 7; // セッションから値を取得し、1を減らす
        session(['week_count' => $week_count]); // セッションに新しい値を保存
        return view('posts.week')->with(['week_count'=> $week_count, 'posts' => $post, 'weeks' => $week]); // ビューに変数を渡す
    }
}
