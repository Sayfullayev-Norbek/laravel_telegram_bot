<?php

namespace App\Service;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LeadService
{
    public function store(array $lead): Model|Builder
    {
        return Lead::query()->create($lead);
    }
}

