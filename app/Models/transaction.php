<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class transaction extends Model
{
    use HasFactory , SoftDeletes, LogsActivity;

    protected $fillable = [
        'user_id',
        'type',
        'amount',
    ];

    public static function store( int $user_id, string $type, float $amount)
    {
        return self::create([
            'user_id' => $user_id,
            'type' => $type,
            'amount' => $amount,
        ]);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('Transaction')
            ->logOnly($this->fillable)
            ->logOnlyDirty();
    }
}
