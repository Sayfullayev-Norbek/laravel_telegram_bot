<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_group extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function company(){
        return $this->hasMany(Company::class);
    }
    public function lead(){
        return $this->hasMany(Lead::class);
    }
}
