<?php

namespace Lizhineng\Sharable\Tests;

use Lizhineng\Sharable\Tests\Diary;

class ShareTest extends TestCase
{
    /** @test */
    public function it_has_unique_token()
    {
        $this->assertNotNull($this->sharing->token);
    }

    /** @test */
    public function it_has_sharable_model()
    {
        $this->assertInstanceOf(Diary::class, $this->sharing->sharable);
    }

    /** @test */
    public function it_has_members()
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->sharing->members);
    }

    /** @test */
    public function it_has_quota()
    {
        $this->assertEquals(1, $this->sharing->allows);
    }
}
