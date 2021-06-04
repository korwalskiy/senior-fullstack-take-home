<?php

namespace Application\Entity;

class Company extends ActiveRecord
{
    const TABLE_NAME = 'companies';

    public string $name;

    public string $email;

    public string $logo_url;

    public string $address;

    public string $country;

    public float $tax_rate;

    public function fullAddress()
    {
        return $this->address . ", " . $this->country;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'logo_url' => $this->logo_url,
            'tax_rate' => $this->tax_rate,
            'address' => $this->fullAddress()
        ];
    }

    public static function get_company_services(int $company_id)
    {
        $sql = "SELECT *
                FROM `services`
                WHERE `company_id` = ?
            ";

        $args = [$company_id];

        return self::query('Service', $sql, $args);
    }

    public static function get_company_service_by_id(int $company_id, int $service_id)
    {
        $sql = "SELECT *
                FROM `services`
                WHERE `company_id` = ?
                AND `id` = ?
            ";

        $args = [$company_id, $service_id];

        return self::query('Service', $sql, $args);
    }

    public static function delete_company_service_by_id(int $company_id, int $service_id)
    {
        $sql = "DELETE
                FROM `services`
                WHERE `company_id` = ?
                AND `id` = ?
            ";

        $args = [$company_id, $service_id];

        return self::query('Service', $sql, $args);
    }

    public static function get_company_employees(int $company_id)
    {
        $sql = "SELECT *
                FROM `employees`
                WHERE `company_id` = ?
            ";

        $args = [$company_id];

        return self::query('Employee', $sql, $args);
    }

    public static function get_company_employee_by_id(int $company_id, int $employee_id)
    {
        $sql = "SELECT *
                FROM `employees`
                WHERE `company_id` = ?
                AND `id` = ?
            ";

        $args = [$company_id, $employee_id];

        return self::query('Employee', $sql, $args);
    }

    public static function delete_company_employee_by_id(int $company_id, int $employee_id)
    {
        $sql = "DELETE
                FROM `employees`
                WHERE `company_id` = ?
                AND `id` = ?
            ";

        $args = [$company_id, $employee_id];

        return self::query('Employee', $sql, $args);
    }
}
