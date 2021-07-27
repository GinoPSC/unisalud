<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HumanName extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'use',
        'text',
        'fathers_family',
        'mothers_family',
        'prefix',
        'suffix',
        'period_id',
    ];

    public function getfullNameAttribute()
    {
        return "{$this->text} {$this->fathers_family} {$this->mothers_family}";
    }

}
