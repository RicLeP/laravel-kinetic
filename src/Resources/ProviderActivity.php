<?php

namespace Riclep\KineticApi\Resources;

class ProviderActivity extends KineticResource
{
    protected ?string $providerId = null;

    protected function getResourceEndpoint(): string
    {
        return 'providers/activity';
    }

    protected function getFilterResourceEndpoint(): string
    {
        return $this->getResourceEndpoint();
    }

    /**
     * Set the provider ID for filtering activities
     *
     * @param string $providerId
     * @return $this
     */
    public function forProvider(string $providerId): self
    {
        $this->providerId = $providerId;
        return $this;
    }

    /**
     * Get activities with pagination support
     *
     * @param array $params Additional parameters
     * @return array
     */
    public function all(array $params = []): array
    {
        if ($this->providerId) {
            $params['providerId'] = $this->providerId;
        }

        return parent::all($params);
    }
}
