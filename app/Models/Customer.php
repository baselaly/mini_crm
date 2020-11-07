<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'source', 'employee_id'
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
    public function setSourceAttribute($value): void
    {
        $this->attributes['source'] = $value;
    }

    /**
     * @param mixed $value
     * 
     * @return string|null
     */
    public function getSourceAttribute($value): ?string
    {
        return $value;
    }

    /**
     * @return BelongsTo
     */
    public function employee(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'employee_id');
    }
}
