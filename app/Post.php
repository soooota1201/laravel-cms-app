<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use App\Category; 
use App\User; 

class Post extends Model
{
  use SoftDeletes;

  protected $fillable = [
    'title','description','content','image','published_at','category_id'
  ];

  public function deleteImage()
  {
    Storage::delete($this->image);
  }

  //リレーション(１対多)
  public function category() {
    return $this->belongsTo(Category::class);
  }

  //リレーション(多対多)
  public function tags()
  {
    return $this->belongsToMany(Tag::class);
  }

  /** 
   * 
   * check if post has tag
   * 
   * @return boot
   * 
   */

  public function hasTag($tagId)
  {
    return in_array($tagId, $this->tags->pluck('id')->toArray());
  }

  //リレーション(１対多)
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function scopeSearched($query)
  {
    $search = request()->query('search');

    if (!$search) {
      return $query;
    }

    return $query->where('title', 'LIKE', "%{$search}%");
  }
}
