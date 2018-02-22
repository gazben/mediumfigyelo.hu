<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeywordCount extends Model
{
    public function siteState()
    {
        return $this->belongsTo(SiteState::class);
    }

    public function keyword()
    {
        return $this->belongsTo(Keyword::class);
    }
}
