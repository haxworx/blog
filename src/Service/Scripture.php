<?php

namespace App\Service;

class Scripture
{
    public function __construct()
    {
    }

    public function __destruct()
    {
    }

    public function getVerse(): string
    {
        $txt = '';
        $lines = explode("\n", file_get_contents('kjv.txt'));
        $n = count($lines);

        $line = $lines[random_int(0, $n - 1)];
        if (preg_match('/^(\w+\d+:\d+)\s+(.*?)$/', $line, $matches)) {
            $txt = sprintf("%s -- %s", $matches[2], $matches[1]);
        }

        return $txt;
    }
}
