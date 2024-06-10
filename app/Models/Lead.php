<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = ['telegram_id', 'telegram_name', 'lead_name', 'lead_phone', 'modme_company_id', 'modme_branch_id'];

    public function company() :BelongsTo
    {
        return $this->belongsTo(Company::class, 'modme_company_id');
    }
}
