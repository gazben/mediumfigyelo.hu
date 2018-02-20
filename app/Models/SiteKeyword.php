<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteKeyword extends Model
{
    protected $dates = [
        'snapshot_time',
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function key()
    {
        return $this->belongsTo(Keyword::class);
    }
}
