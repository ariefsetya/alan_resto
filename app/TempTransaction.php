<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempTransaction extends Model
{
    //
    protected $guarded = [];

    public function food()
    {
    	return $this->belongsTo(\App\Food::class)->withDefault();
    }
}
