<?php

namespace App\Services\Seo\Modules;

use App\Models\Service;

class ServiceDetailsSeoHandler extends BaseDetailSeoHandler
{
    public function __construct(Service $service)
    {
        parent::__construct($service);
    }

    protected function getRouteName(): string
    {
        return 'website.serviceDetails';
    }

    protected function getRouteParameterName(): string
    {
        return 'service';
    }
}
