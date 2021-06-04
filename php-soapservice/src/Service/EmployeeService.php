<?php

namespace Application\Service;

use Application\Entity\Employee;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class EmployeeService extends BaseService
{
    public function getAll()
    {
        $employees = Employee::all();
        return [
            'data' => $employees
        ];
    }

    public function getEmployeeById()
    {
        try {
            $employee = Employee::find($this->params['id']);
            return [
                'data' => $employee
            ];
        } catch (RecordNotFoundException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }

    public function saveEmployee()
    {
        $employee = new Employee;
        $employee->id = $this->params['id'];
        $employee->first_name = $this->params['first_name'];
        $employee->last_name = $this->params['last_name'];
        $employee->email = $this->params['email'];
        $employee->avatar_url = $this->params['avatar_url'];
        $employee->hourly_rate = $this->params['hourly_rate'];
        $employee->role = $this->params['role'];
        $employee->company_id = $this->params['company_id'];

        if (($response = $employee->save()) === true) {
            if (is_null($this->params['id'])) {
                return [
                    'data' => 'New employee "'. $this->params['first_name'] . '" added'
                ];
            }
            return [
                'data' => 'Employee "'. $this->params['first_name'] . '" updated'
            ];
        }

        return [
            'error' => $response,
            'status_code' => ResponseCode::NOT_MODIFIED
        ];
    }

    public function deleteEmployeeById()
    {
        try {
            $employee = new Employee;
            $employee->id = $this->params['id'];
            $employee->destroy();
            return [
                'data' => 'Deleted employee '. $this->params['id']
            ];
        } catch (RecordNotFoundException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }
}
