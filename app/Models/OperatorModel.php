<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class OperatorModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'operators';

    protected $primaryKey = 'id';
    
    public $incrementing = false; // Karena id menggunakan UUID
    
    protected $keyType = 'string';

    protected $fillable = [
        'nama_operator',
        'username',
        'password',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // Boot method untuk UUID
    protected static function boot()
    {
        parent::boot();

        // Generate UUID saat membuat entri baru
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
