<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    public function keywordCounts()
    {
        return $this->hasMany(KeywordCount::class);
    }
}
