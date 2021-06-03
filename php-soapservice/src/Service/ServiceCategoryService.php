<?php

namespace Application\Service;

use Application\Entity\ServiceCategory;
use Application\Exception\NotImplementedException;
use Application\Exception\RecordNotFoundException;

class ServiceCategoryService extends BaseService
{
    public function getAll()
    {
        $categories = ServiceCategory::all();
        return [
            'data' => $categories
        ];
    }

    public function getCategoryById()
    {
        try {
            $category = ServiceCategory::find($this->params['id']);
            return [
                'data' => $category
            ];
        } catch (RecordNotFoundException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }

    public function saveCategory()
    {
        $category = new ServiceCategory;
        $category->id = $this->params['id'];
        $category->name = $this->params['name'];

        if (($response = $category->save()) === true) {
            if (is_null($this->params['id'])) {
                return [
                    'data' => 'New service category '. $this->params['name'] . ' added'
                ];
            }
            return [
                'data' => 'Category '. $this->params['name'] . ' updated'
            ];
        }

        return [
            'error' => $response,
            'status_code' => ResponseCode::NOT_MODIFIED
        ];
    }

    public function deleteCategoryById()
    {
        try {
            $category = new ServiceCategory;
            $category->id = $this->params['id'];
            $category->destroy();
            return [
                'data' => 'Deleted service category '. $this->params['id']
            ];
        } catch (RecordNotFoundException $e) {
            return [
                'error' => $e->getMessage(),
                'status_code' => ResponseCode::NOT_FOUND
            ];
        }
    }
}
