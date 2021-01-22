<?php

namespace Bigmom\Auth\Popo;

class Status
{
    protected int $code;

    protected string $message;
    
    protected $extra;

    public function __construct(int $code, string $message, $extra = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->extra = $extra;
    }

    public function code(): int
    {
        return $this->code;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function extra()
    {
        return $this->extra;
    }

    public function all()
    {
        return [
            'code' => $this->code(),
            'message' => $this->message(),
            'extra' => $this->extra(),
        ];
    }
}
