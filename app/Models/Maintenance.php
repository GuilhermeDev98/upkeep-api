<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'reason', 'vehicle_id', 'user_id'
    ];

    public function vehicle(){
        return $this->belongsTo('App\Models\Vehicle');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    protected $dates = ['schedule'];
}
