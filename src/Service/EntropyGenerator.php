<?php

namespace App\Service;

class EntropyGenerator
{
    private $f;

    public function __construct(
        private int $length = 15,
    )
    {
        $this->f = fopen('kjv.txt', 'r');
        if (!$this->f) {
            throw new \Exception('Unable to open source file.');
        }
    }

    public function __destruct()
    {
        if ($this->f) {
            fclose($this->f);
        }
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): static
    {
        $this->length = $length;

        return $this;
    }

    public function create(string $message): string
    {
        $seed = 0;
        $text = '';
        $st = fstat($this->f);

        for ($i = 0; $i < $this->length; $i++) {
            for ($j = 0; $j < strlen($message); $j++) {
                $seed += ord($message[$j]);
            }
            mt_srand($seed + random_int(0, $st['size']));
            $offset = mt_rand(0, $st['size'] - 1);
            fseek($this->f, $offset);
            $line = fgets($this->f);
            if (preg_match('/\s+(\w+)\s+/', $line, $matches)) {
                $text .= ' ' . $matches[1];
            }
        }
        return $text;
    }
}
