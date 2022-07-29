<?php

namespace ConfettiCode\Inertiajs\Notifications\Concerns;

trait HasType
{
    protected string $type;

    public function type(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
