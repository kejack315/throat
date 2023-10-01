<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefinitionRating extends Model
{
    use HasFactory;
    protected $fillable = ['stars', 'user_id']; // 确保 'stars' 在 $fillable 中




    public function word()
    {
        return $this->belongsTo(Word::class);
    }

    public function definition()
    {
        return $this->belongsTo(Definition::class);
    }

    public function rating()
    {
        return $this->belongsTo(Rating::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
