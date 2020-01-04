<?php

namespace Lizhineng\Sharable\Tests;

use Lizhineng\Sharable\CanBeShared;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use CanBeShared;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
}
