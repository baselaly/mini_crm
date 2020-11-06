<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @param mixed $value
     * 
     * @return void
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
    }

    /**
     * @param mixed $value
     * 
     * @return string|null
     */
    public function getNameAttribute($value): ?string
    {
        return $value;
    }

    /**
     * @param mixed $value
     * 
     * @return void
     */
    public function setPhoneAttribute($value): void
    {
        $this->attributes['phone'] = $value;
    }

    /**
     * @param mixed $value
     * 
     * @return string|null
     */
    public function getPhoneAttribute($value): ?string
    {
        return $value;
    }

    /**
     * @param mixed $value
     * 
     * @return void
     */
    public function setEmailAttribute($value): void
    {
        $this->attributes['email'] = $value;
    }

    /**
     * @param mixed $value
     * 
     * @return string|null
     */
    public function getEmailAttribute($value): ?string
    {
        return $value;
    }

    /**
     * @param mixed $value
     * 
     * @return void
     */
    public function setPasswordAttribute($value): void
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
