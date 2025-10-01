<?php

namespace Riclep\KineticApi\Resources;

class Volunteer extends KineticResource
{
    protected function getResourceEndpoint(): string
    {
        return 'volunteers';
    }

    protected function getFilterResourceEndpoint(): string
    {
        return $this->getResourceEndpoint() . '/filter';
    }
}
