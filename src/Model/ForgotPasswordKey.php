<?php

namespace SmNet\LaravelRlf\Model;


use Illuminate\Database\Eloquent\Model;

class ForgotPasswordKey extends Model
{
    protected $fillable = [
        'user_id',
        'key',
        'status'
    ];
}