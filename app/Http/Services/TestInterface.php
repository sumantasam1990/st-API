<?php

namespace App\Http\Services;

interface TestInterface
{
    public function getFullName(string $name);
    public function getAge(int $age);
}
