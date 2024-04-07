<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title',
        'image',
        'reference',
        'amount',
        'make',
        'category_id',
        'user_id'
    ];
    
    public function getPaginateByLimit(int $limit_count =10){
        return $this->orderby('updated_at', 'DESC')->paginate($limit_count);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    
    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }
    
    public function weeks(){
        return $this->hasMany(Week::class);
    }
        
    public function user(){
        return $this->belongsTo(User::class);
    }
}
