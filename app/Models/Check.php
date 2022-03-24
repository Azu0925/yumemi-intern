<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'checks';

    protected $fillable = [
        'user_id',
        'check_item_id',
        'event_id'
    ];
}
