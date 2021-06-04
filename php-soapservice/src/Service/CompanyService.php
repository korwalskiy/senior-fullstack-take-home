<?php

namespace Application\Service;

use Application\Entity\Company;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;
use Application\Exception\BadQueryException;

class CompanyService extends BaseService
{
    public function helloFromPHP()
    {
        return [
            'data' => 'Hello from devs @ 10HL'
        ];
    }

    public function getCompanyById()
    {
        try {
            $company = Company::find($this->params['id']);
            return [
                'data' => $company
            ];
        } catch (RecordNotFoundException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }

    public function getAllCompanies()
    {
        $companies = Company::all();
        return [
            'data' => $companies
        ];
    }

    public function saveCompany()
    {
        $company = new Company;
        $company->id = $this->params['id'];
        $company->name = $this->params['name'];
        $company->email = $this->params['email'];
        $company->logo_url = $this->params['logo_url'];
        $company->address = $this->params['address'];
        $company->country = $this->params['country'];
        $company->tax_rate = $this->params['tax_rate'];
        $company->save();

        if (is_null($this->params['id'])) {
            return [
                'data' => 'New company '. $this->params['name'] . ' added'
            ];
        }
        return [
            'data' => 'Company '. $this->params['name'] . ' updated'
        ];
    }

    public function deleteCompanyById()
    {
        try {
            $company = new Company;
            $company->id = $this->params['id'];
            $company->destroy();
            return [
                'data' => 'Deleted company '. $this->params['id']
            ];
        } catch (RecordNotFoundException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }

    public function getAllCompanyServices()
    {
        try {
            $companyServices = Company::get_company_services($this->params['company_id']);
            return [
                'data' => $companyServices
            ];
        } catch (BadQueryException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }

    public function getCompanyServiceById()
    {
        try {
            $service = Company::get_company_service_by_id($this->params['company_id'], $this->params['service_id']);
            return [
                'data' => $service
            ];
        } catch (BadQueryException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }

    public function deleteCompanyServiceById()
    {
        try {
            Company::delete_company_service_by_id($this->params['company_id'], $this->params['service_id']);
            return [
                'data' => []
            ];
        } catch (BadQueryException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }

    public function getCompanyEmployees()
    {
        try {
            $companyEmployees = Company::get_company_employees($this->params['company_id']);
            return [
                'data' => $companyEmployees
            ];
        } catch (BadQueryException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }

    public function getCompanyEmployeeById()
    {
        try {
            $employee = Company::get_company_employee_by_id($this->params['company_id'], $this->params['employee_id']);
            return [
                'data' => $employee
            ];
        } catch (BadQueryException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }

    public function deleteCompanyEmployeeById()
    {
        try {
            Company::delete_company_employee_by_id($this->params['company_id'], $this->params['employee_id']);
            return [
                'data' => []
            ];
        } catch (BadQueryException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }
}
