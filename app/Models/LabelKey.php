<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabelKey extends Model
{
    public function labels()
    {
        return $this->hasMany(Label::class);
    }
}
