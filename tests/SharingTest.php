<?php

namespace Lizhineng\Sharable\Tests;

use Lizhineng\Sharable\Sharing;

class SharingTest extends TestCase
{
    /** @test */
    public function it_generates_a_sharing_model()
    {
        $share = $this->diary->share()->generate();

        $this->assertInstanceOf(Sharing::class, $share);
    }

    /** @test */
    public function it_can_generate_with_given_user()
    {
        $sharing = $this->diary
            ->share()
            ->with($this->user)
            ->generate();

        $this->assertCount(1, $sharing->members);
        $this->assertTrue($sharing->members->contains($this->user));
    }

    /** @test */
    public function it_can_generate_with_quota()
    {
        $share = $this->diary->share()->allows(5)->generate();

        $this->assertEquals(5, $share->allows);
    }
}
