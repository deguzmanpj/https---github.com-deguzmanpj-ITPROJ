<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'userId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'pass',
        'email',
        'contact_no',
        'role'
    ];

    // Accessor method for the 'contact_no' attribute
    public function getContactAttribute()
    {
        Log::info( $this->attributes['contact_no'] . "hello");
        return $this->attributes['contact_no'];
      
    }

    // Mutator method for the 'contact_no' attribute
    public function setContactAttribute($value)
    {
        $this->attributes['contact_no'] = $value;
    }



 
}
