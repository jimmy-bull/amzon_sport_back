<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\phone;
use App\Models\PostTable;
use App\Models\ImageVideoTable;
use App\Models\Comment;
use App\MOdels\roles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'siteid'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * Get the phone associated with the user.
     */
    public function phone()
    {
        return $this->hasOne(phone::class, 'users_id');
    }
    public function post()
    {
        //return $this->hasManyThrough(ImageVideoTable::class, PostTable::class, "user_id", "post_id");
    }
    public function post_table_from_comment()
    {
        /**
         * Summary of role
         * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
         * Pour avoir les post apartir des commentaire et users
         */
        return $this->belongsToMany(PostTable::class, "comments", "who_commented_id", "post_id")->withPivot('comment');
        // ->wherePivot('comment', 'This is for the pain');
    }
    public function role()
    {
        return $this->belongsToMany(roles::class, "role_users", 'user_id', 'role_id');
        /**
         * la table de base users est relier avec user_id
         * et la table roles est relier par role_id
         */
    }
}
