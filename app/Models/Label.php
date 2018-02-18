<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function key()
    {
        return $this->belongsTo(LabelKey::class);
    }
}
