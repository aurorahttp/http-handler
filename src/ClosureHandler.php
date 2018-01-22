<?php

namespace Aurora\Http\Handle;

class ClosureHandler implements HandlerInterface
{
    protected $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public static function create(callable $callback)
    {
        return new static($callback);
    }

    public function handle($request, HandlerInterface $next)
    {
        return $next->handle(call_user_func($this->callback, $request, $next), $next);
    }
}