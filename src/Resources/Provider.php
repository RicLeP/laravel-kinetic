<?php

namespace Riclep\KineticApi\Resources;

class Provider extends KineticResource
{
    protected function getResourceEndpoint(): string
    {
        return 'providers';
    }

    protected function getFilterResourceEndpoint(): string
    {
        return $this->getResourceEndpoint();
    }

    /**
     * Get activities for providers
     *
     * @param string|null $providerId Provider GUID (optional)
     * @return ProviderActivity
     */
    public function activities(?string $providerId = null): ProviderActivity
    {
        $activity = new ProviderActivity($this->client);

        if ($providerId) {
            $activity->forProvider($providerId);
        }

        return $activity;
    }
}
