<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company_group extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'telegram_chat_id'];

//    public function companies(){
//        return $this->hasOne(Company::class);
//    }
//    public function leads(){
//        return $this->hasOne(Lead::class);
//    }
}
