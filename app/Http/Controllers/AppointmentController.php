<?php

namespace App\Http\Controllers;

use App\Http\Services\TestInterface;
use App\Http\Traits\AppointmentTrait;

class AppointmentController extends Controller
{
    use AppointmentTrait;

    public TestInterface $test;

    public function __construct(TestInterface $test)
    {
        $this->test = $test;
    }

    public function getTestName(string $name)
    {
        return $this->test->getFullName($name);
    }

    public function getTestAge(TestInterface $test, int $age)
    {
        return $test->getAge($age);
    }
}
