<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $log) {
            $log->uuid = $log->uuid ?? (string) Str::uuid();
        });

        static::updating(function(self $log) {
            if($log->isDirty('uuid')){
                $log->uuid = $log->getOriginal('uuid');
            }
        });
    }
}
