<?php

namespace Lizhineng\Sharable;

use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Sharing extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $share) {
            $share->token = (string) Str::uuid();
        });
    }

    public function sharable()
    {
        return $this->morphTo('sharable');
    }

    public function members()
    {
        $tableName = config('sharable.table_names.model_has_collaborators');

        return $this->belongsToMany(User::class, $tableName, 'sharing_id', 'user_id');
    }
}
