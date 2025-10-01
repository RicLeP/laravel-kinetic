<?php

namespace Riclep\KineticApi\Resources;

class Task extends KineticResource
{
    protected function getResourceEndpoint(): string
    {
        return 'tasks';
    }

    protected function getFilterResourceEndpoint(): string
    {
        return $this->getResourceEndpoint() . '/filter';
    }
}
