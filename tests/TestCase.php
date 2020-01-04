<?php

namespace Lizhineng\Sharable\Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * A diary instance for testing.
     *
     * @var \Lizhineng\Sharable\Tests\Diary
     */
    protected $diary;

    /**
     * A user instance for testing.
     *
     * @var \Illuminate\Foundation\Auth\User
     */
    protected $user;

    /**
     * A sharing instance for testing.
     *
     * @var \Lizhineng\Sharable\Sharing
     */
    protected $sharing;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function setUpDatabase()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->artisan('migrate');

        $this->diary = Diary::create(['title' => 'Test Diary']);

        $this->user = User::create(['email' => 'fake@user.test']);

        $this->sharing = $this->diary
            ->share()
            ->with($this->user)
            ->generate();
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return ['Lizhineng\Sharable\SharableServiceProvider'];
    }
}
