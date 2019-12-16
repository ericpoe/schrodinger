<?php

declare(strict_types=1);

namespace Schrodinger;

class Schrodinger
{
    protected const STATUS_ALIVE = 'ALIVE';
    protected const STATUS_DEAD = 'DEAD';
    protected const STATUS_BOTH = 'BOTH';

    protected bool $isStatusObserved;
    protected string $status;

    public function __construct()
    {
        $this->isStatusObserved = false;
        $this->status = self::STATUS_BOTH;
    }

    /**
     * Observe the Schrodinger
     *
     * Before it is observed, the Schrodinger is in a state of quantum superposition.
     * Once it is observed, quantum superposition ends and the Schrodinger's reality
     * collapses into one state: Alive or Dead.
     */
    public function observe(): void
    {
        if ($this->isStatusObserved) {
            return;
        }

        $this->isStatusObserved = true;

        $viviStates = [
            self::STATUS_ALIVE,
            self::STATUS_DEAD,
        ];
        shuffle($viviStates);

        $this->status = $viviStates[0];
    }

    public function isAlive(): bool
    {
        return $this->status === self::STATUS_ALIVE || $this->status === self::STATUS_BOTH;
    }

    public function isDead(): bool
    {
        return $this->status === self::STATUS_DEAD || $this->status === self::STATUS_BOTH;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
