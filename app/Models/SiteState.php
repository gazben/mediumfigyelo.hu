<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteState extends Model
{
    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
