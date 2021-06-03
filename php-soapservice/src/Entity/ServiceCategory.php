<?php

namespace Application\Entity;

class ServiceCategory extends ActiveRecord
{
    const TABLE_NAME = 'service_categories';

    public string $name;

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
