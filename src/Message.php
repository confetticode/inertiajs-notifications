<?php

namespace ConfettiCode\Inertiajs\Notifications;

use Closure;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;

class Message implements Arrayable
{
    use Concerns\HasTitle;
    use Concerns\HasType;
    use Concerns\HasDuration;

    protected string $body;
    protected array $actions = [];

    private Request $request;
    private static ?Closure $resolver = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public static function factory(Closure $resolver)
    {
        static::$resolver = $resolver;
    }

    public static function create(): static
    {
        $instance = call_user_func(static::$resolver);

        if (!$instance instanceof static) {
            throw new \RuntimeException(
                sprintf('The resolver must create a new instance of %s.', self::class)
            );
        }

        return $instance;
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
            'duration' => $this->durationInSeconds * 1000 ?? null,
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
