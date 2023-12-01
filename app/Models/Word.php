<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'word',
        'word_type_id',
        'user_id'
    ];

//    protected $fillable = ['word', 'definition', 'word_type_id', 'user_id'];

//    protected $attributes = [
//        'word_type_id' => null,
//        'user_id' => null,
//    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public function wordType()
    {
        return $this->belongsTo(WordType::class);
    }

    public function definitions()
    {
        return $this->hasMany(Definition::class);
    }

    public function definitionCount(){
        return $this->definitions()->count();
    }

    public static function boot()
    {
        parent::boot();
        // 在删除 word 时触发的事件处理
        static::deleting(function ($word) {
            // 删除与该 word 相关的 definition 数据
            $word->definitions()->delete();
        });
    }

}
