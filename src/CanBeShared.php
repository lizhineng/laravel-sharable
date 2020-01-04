<?php

namespace Lizhineng\Sharable;

use Lizhineng\Sharable\Tests\User;

trait CanBeShared
{
    public function share()
    {
        return Share::of($this);
    }

    public function collaborators()
    {
        $tableName = config('sharable.table_names.model_has_collaborators');

        return $this->morphToMany(User::class, 'model', $tableName);
    }
}
