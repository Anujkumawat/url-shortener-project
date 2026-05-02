<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Company;

class Url extends Model
{
    protected $fillable = [
        'user_id',
        'company_id',
        'original_url',
        'short_code',
        'clicks'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
