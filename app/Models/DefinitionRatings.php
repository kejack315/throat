<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DefinitionRatings extends Pivot
{
    use HasFactory;
    protected $fillable = ['stars', 'user_id'];


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
