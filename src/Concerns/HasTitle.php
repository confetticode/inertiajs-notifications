<?php

namespace ConfettiCode\Inertiajs\Notifications\Concerns;

trait HasTitle
{
    protected string $title;

    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
