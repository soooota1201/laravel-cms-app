<?php

namespace App;
use App\Post; 
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
  protected $fillable = [
    'name'
  ];

  //リレーション(多対多)
  public function post()
  {
    return $this->belongsToMany(Post::class);
  }
}
