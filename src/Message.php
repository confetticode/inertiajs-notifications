<?php

namespace ConfettiCode\Inertiajs\Notifications;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class Message implements Arrayable
{
    protected Request $request;
    protected string $title;
    protected string $type;
    protected array $actions = [];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function success(): self
    {
        $this->type = 'success';

        return $this;
    }

    public function danger(): self
    {
        $this->type = 'danger';

        return $this;
    }

    public function info(): self
    {
        $this->type = 'info';

        return $this;
    }

    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function body(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function actions(array $actions): self
    {
        $this->actions = $actions;

        return $this;
    }


    public function toArray()
    {
        return [
            'title' => $this->title,
            'type' => $this->type,
            'body' => $this->body,
            'actions' => collect($this->actions)->toArray(),
        ];
    }

    public function send(): void
    {
        $notifications = $this->request->session()->get('inertiajs_notifications');

        if (!is_array($notifications)) {
            $notifications = [];
        }

        $notifications[] = $this->toArray();

        $this->request->session()->flash('inertiajs_notifications', $notifications);
    }
}
