<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{

    public function User ()

    {
        return $this->belongsTo('App\User');
    }

    public function Category ()

    {
        return $this->belongsTo('App\Category');
    }

    public function getRouteKeyName()

    {
        return 'slug';
    }

    public function tags () {

        return $this->belongsToMany('App\Tag');
    }


    protected $fillable = ['title', 'content', 'slug', 'user_id', 'category_id'];

    // funzione di generazione dello slug
    static public function slugGenerator($originalString) {

        $originalSlug = Str::of($originalString)->slug('-')->__toString();
        $updatedSlug = $originalSlug;
        $_i = 1;

        while(self::where('slug', $updatedSlug)->first()) {
            $updatedSlug = "$originalSlug-$_i";
            $_i++;
        }

        return $updatedSlug;
    }
}
