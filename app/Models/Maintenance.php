<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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
    protected function date(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value,
            set: fn ($value) => Carbon::createFromFormat('d/m/Y', $value),
        );
    }
    protected $dates = ['schedule'];
}
