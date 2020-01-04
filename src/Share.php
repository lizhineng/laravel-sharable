<?php

namespace Lizhineng\Sharable;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;

class Share
{
    protected $model;

    protected $users = [];

    protected $allows = 1;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public static function of(Model $model)
    {
        return new self($model);
    }

    public function with(User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    public function allows(int $count)
    {
        $this->allows = $count;

        return $this;
    }

    public function generate()
    {
        $sharing = Sharing::make([
            'allows' => $this->allows,
        ]);

        $sharing->sharable()->associate($this->model);

        $sharing->save();

        if (! empty($this->users)) {
            $this->model->collaborators()->attach(
                collect($this->users)->pluck('id'),
                ['sharing_id' => $sharing->id]
            );
        }

        return $sharing;
    }
}
