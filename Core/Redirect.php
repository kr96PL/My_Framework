<?php 

declare(strict_types = 1);

namespace Framework\Core;

final class Redirect
{
    public function to(string $address) 
    {
        header("Location: " . $address);
    }

    public function back(): void
    {
        $referer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : $_SERVER['REMOTE_ADDR'] . ':' . $_SERVER['8000'] . $_SERVER['REQUEST_URI'];
        header("Location: " . $referer);
    }

    public function with(array $data): self
    {
        $_SESSION[key($data)] = $data[key($data)];
        return $this;
    }
}