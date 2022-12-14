<?php

namespace ConfettiCode\Inertiajs\Notifications;

use Illuminate\Contracts\Support\Arrayable;

class Action implements Arrayable
{
    use Concerns\HasTitle;
    use Concerns\HasType;

    protected string $url;

    public static function create()
    {
        return new static;
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'type' => $this->type,
            'url' => $this->url,
        ];
    }

    public function primary(): self
    {
        $this->type = 'primary';

        return $this;
    }

    public function secondary(): self
    {
        $this->type = 'secondary';

        return $this;
    }

    public function url(string $url): self
    {
        $this->url = $url;

        return $this;
    }
}
