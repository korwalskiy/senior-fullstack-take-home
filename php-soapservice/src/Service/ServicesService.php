<?php

namespace Application\Service;

use Application\Entity\Service;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class ServicesService extends BaseService
{
    public function getAll()
    {
        $services = Service::all();
        return [
            'data' => $services
        ];
    }

    public function getServiceById()
    {
        try {
            $service = Service::find($this->params['id']);
            return [
                'data' => $service
            ];
        } catch (RecordNotFoundException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }

    public function saveService()
    {
        $service = new Service;
        $service->id = $this->params['id'];
        $service->name = $this->params['name'];
        $service->company_id = $this->params['company_id'];
        $service->service_category_id = $this->params['service_category_id'];

        if (($response = $service->save()) === true) {
            if (is_null($this->params['id'])) {
                return [
                    'data' => 'New service '. $this->params['name'] . ' added'
                ];
            }
            return [
                'data' => 'Service '. $this->params['name'] . ' updated'
            ];
        }

        return [
            'error' => $response,
            'status_code' => ResponseCode::NOT_MODIFIED
        ];
    }

    public function deleteServiceById()
    {
        try {
            $service = new Service;
            $service->id = $this->params['id'];
            $service->destroy();
            return [
                'data' => 'Deleted service '. $this->params['id']
            ];
        } catch (RecordNotFoundException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }
}
