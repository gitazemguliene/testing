<?php

namespace App\Services;

class AgeCalculator
{
    protected $birthday ;

    /**
     * AgeCalculator constructor.
     * @param $birthday
     */
    public function __construct($birthday)
    {
        $this->birthday = \DateTime::createFromFormat('Y-m-d', $birthday);
    }

    public function getAge()
    {
        $now = new \DateTime('now');
        $age = $now->diff($this->getBirthday());

        return $age->format('%y years old.');
    }

    public function getBirthday()
    {
        return $this->birthday;
    }
}
