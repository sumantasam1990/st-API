<?php

namespace App\Http\Services;

class TestService implements TestInterface
{
    public function getFullName(string $name): string
    {
        return $name;
    }

    public function getAge(int $age): int
    {
        return $age;
    }
}
