<?php

namespace Lizhineng\Sharable\Tests;

class CanBeSharedTest extends TestCase
{
    /** @test */
    public function it_may_has_collaborators()
    {
        $this->assertCount(1, $this->diary->collaborators);
        $this->assertTrue($this->diary->collaborators->contains($this->user));
    }
}
