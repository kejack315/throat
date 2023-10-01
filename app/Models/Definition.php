<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Definition extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'word_id',
        'definition',
        'user_id',
        'appropriate',
        'user_name',
        'rating_stars',
        'rating_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function wordType()
    {
        return $this->belongsTo(WordType::class);
    }
    public function definitionCount(){
        return $this->definitions()->count();
    }
//    public function definitions()
//    {
//        return $this->hasMany(Definition::class, 'definition_id', 'id');
//    }

//    public function definitionRatings()
//    {
//        return $this->hasMany(DefinitionRating::class, 'definition_id');
//    }
    public function ratings()
    {
        return $this->belongsToMany(Rating::class, 'definition_ratings')
            ->using(DefinitionRatings::class)
            ->withPivot('stars');
    }

//    public function definitionRating()
//    {
//        // 定义与 definitionRating 表的关联
//        return $this->hasMany(DefinitionRating::class);
//    }


}
