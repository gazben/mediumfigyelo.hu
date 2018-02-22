<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    public function states()
    {
        return $this->hasMany(SiteState::class);
    }

    public function keywordCounts()
    {
        return $this->hasMany(KeywordCount::class);
    }
}
