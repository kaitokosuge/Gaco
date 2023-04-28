<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'link',
        'html',
        'css',
        'js',
        'explanation'
    ];
    public function getPaginateByLimit(int $limit = 21)
    {
        return $this->orderBy('updated_at', 'DESC')->paginate($limit);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function is_liked_by_auth_user()
    {
        $id = \Auth::id();

        $likers = array();
        foreach($this->likes as $like) {
            array_push($likers, $like->user_id);
        }

        if (in_array($id, $likers)) {
            return true;
        } else {
        return false;
        }
    }
}
