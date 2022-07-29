<?php

namespace ConfettiCode\Inertiajs\Notifications\Concerns;

trait HasDuration
{
    protected int $durationInSeconds;

    public function duration(int $seconds): self
    {
        $this->durationInSeconds  = $seconds;

        return $this;
    }
}
