<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function Articles()
    {
        return $this->hasMany(Article::class);
    }
    public function followers()
    {
        return $this->belongsToMany(self::class,'follows','followee_id','follower_id');
    }
    public function followees(){
        //followsはテーブル名,次はカラム名
        return $this->belongsToMany(self::class,'follows','follower_id','followee_id');
    }
    public function modelUnfollow(Int $user_id)
    {
        return $this->followees()->detach($user_id);
    }
    public function isFollowing(Int $user_id)
    {
        return $this->followees()->where('followee_id',$user_id)->exists();
    }
}
