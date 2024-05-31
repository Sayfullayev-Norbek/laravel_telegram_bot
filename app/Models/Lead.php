<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = ['telegram_id', 'telegram_name', 'lead_name', 'lead_phone', 'modme_company_id', 'modme_branch_id', 'modme_section_id'];

    public function company_group()
    {
        return $this->belongsTo(Company_group::class);
    }
}
