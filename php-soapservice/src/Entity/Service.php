<?php

namespace Application\Entity;

class Service extends ActiveRecord
{
    const TABLE_NAME = 'services';

    public string $name;

    public int $company_id;

    public int $service_category_id;

    public function getCompany()
    {
        return Company::find($this->company_id);
    }

    public function getServiceCategory()
    {
        return ServiceCategory::find($this->service_category_id);
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'company' => $this->getCompany(),
            'company' => [
                'id' => $this->company_id,
                'name' => $this->getCompany()->name
            ],
            'service_category' => [
                'id' => $this->service_category_id,
                'name' => $this->getServiceCategory()->name
            ]
        ];
    }
}
