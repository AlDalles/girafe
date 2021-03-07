<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Advert extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'image_patch'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
