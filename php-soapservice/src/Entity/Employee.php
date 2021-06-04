<?php

namespace Application\Entity;

class Employee extends ActiveRecord
{
    const TABLE_NAME = 'employees';

    public string $first_name;

    public string $last_name;

    public string $avatar_url;

    public string $email;

    public string $role;

    public int $company_id;

    public float $hourly_rate;

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getCompany()
    {
        return Company::find($this->company_id);
    }


    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->getFullName(),
            'avatar_url' => $this->avatar_url,
            'email' => $this->email,
            'role' => $this->role,
            'hourly_rate' => $this->hourly_rate,
            'company' => [
                'id' => $this->company_id,
                'name' => $this->getCompany()->name
            ]
        ];
    }
}
