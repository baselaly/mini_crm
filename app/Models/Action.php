<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class Action extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type', 'description', 'record', 'customer_id'
    ];

    /**
     * @param mixed $value
     * 
     * @return void
     */
    public function setTypeAttribute($value): void
    {
        $this->attributes['type'] = $value;
    }

    /**
     * @param mixed $value
     * 
     * @return string|null
     */
    public function getTypeAttribute($value): ?string
    {
        return $value;
    }

    /**
     * @param mixed $value
     * 
     * @return void
     */
    public function setDescriptionAttribute($value): void
    {
        $this->attributes['description'] = $value;
    }

    /**
     * @param mixed $value
     * 
     * @return string|null
     */
    public function getDescriptionAttribute($value): ?string
    {
        return $value;
    }

    public function setRecordAttribute($value)
    {
        $fileName = time() . uniqid() . '.' . $value->extension();
        if (!Storage::disk('records')->put($fileName, File::get($value))) {
            throw new \Exception('error in uploading store image');
        }

        $this->attributes['record'] = $fileName;
    }

    public function getRecordAttribute($value)
    {
        if (!$value) {
            return $value;
        }
        return asset('storage/records/' . $value);
    }

    /**
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Models\Customer');
    }
}
