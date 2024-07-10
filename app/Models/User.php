<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'user_type_id', 'office_id',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function documentFiles()
    {
        return $this->hasMany(DocumentFile::class, 'uploaded_by');
    }
}