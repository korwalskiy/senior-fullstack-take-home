<?php

namespace Application\Service;

use Application\Entity\Service;
use Application\Entity\ServiceRate;
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

    public function getServiceRate()
    {
        try {
            $rate = Service::get_service_rate($this->params['service_id']);
            return [
                'data' => $rate
            ];
        } catch (BadQueryException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }

    public function saveServiceRate()
    {
        $rate = new ServiceRate;

        $db_rate = Service::get_service_rate($this->params['service_id']);
        if (count($db_rate) && array_key_exists('id', $db_rate[0])) {
            $rate->id = $db_rate[0]->id;
        }
        else {
            $rate->id = $this->params['id'];
        }

        $rate->service_id = $this->params['service_id'];
        $rate->unit = $this->params['unit'];
        $rate->amount = $this->params['amount'];
        $rate->duration = $this->params['duration'];
        $rate->supply_markup = $this->params['supply_markup'];
        $rate->overhead_markup = $this->params['overhead_markup'];
        $rate->misc_markup = $this->params['misc_markup'];

        if (($response = $rate->save()) === true) {
            $service = Service::find($this->params['service_id']);
            if (is_null($rate->id)) {
                return [
                    'data' => 'Posted new rate for '. $service->name . ' service'
                ];
            }
            return [
                'data' => 'Updated rate for '. $service->name . ' service'
            ];
        }

        return [
            'error' => $response,
            'status_code' => ResponseCode::NOT_MODIFIED
        ];
    }
}
