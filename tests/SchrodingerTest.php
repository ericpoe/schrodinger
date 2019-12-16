<?php

namespace Schrodinger\Tests;

use PHPUnit\Framework\TestCase;
use Schrodinger\Schrodinger;

class SchrodingerTest extends TestCase
{
    protected Schrodinger $schrodinger;

    public function setUp(): void
    {
        $this->schrodinger = new Schrodinger();
    }

    public function testUnobservedStatusIsBoth(): void
    {
        $this->assertSame('BOTH', $this->schrodinger->getStatus());
    }

    public function testUnobservedStatusIsDeadAndAlive(): void
    {
        $this->assertTrue($this->schrodinger->isAlive());
        $this->assertTrue($this->schrodinger->isDead());
    }

    public function testObservedStatusIsEitherDeadOrAlive(): void
    {
        $this->schrodinger->observe();

        $this->assertNotSame('BOTH', $this->schrodinger->getStatus());
        $this->assertStringContainsString($this->schrodinger->getStatus(), 'DEADALIVE');
    }

    public function testObservedStatusIsDeadOrAlive(): void
    {
        $this->schrodinger->observe();

        $this->assertNotSame($this->schrodinger->isAlive(), $this->schrodinger->isDead());
        $this->assertIsBool($this->schrodinger->isAlive());
        $this->assertIsBool($this->schrodinger->isDead());
    }

    public function testObservationCanOnlyTriggerOnce(): void
    {
        $this->schrodinger->observe();

        $isAlive = $this->schrodinger->isAlive();
        $this->assertIsBool($isAlive);

        for ($i = 0; $i < 20; $i++) {
            $this->schrodinger->observe();
            $this->assertSame($isAlive, $this->schrodinger->isAlive());
        }
    }
}
