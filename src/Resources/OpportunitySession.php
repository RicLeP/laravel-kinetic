<?php

namespace Riclep\KineticApi\Resources;

class OpportunitySession extends KineticResource
{
    protected ?int $opportunityId = null;

    protected function getResourceEndpoint(): string
    {
        return 'sessions';
    }

    protected function getFilterResourceEndpoint(): string
    {
        return $this->getResourceEndpoint();
    }

    /**
     * Set the provider ID for filtering sessions
     *
     * @param int $opportunityId
     * @return $this
     */
    public function forOpportunity(int $opportunityId): self {
        if (empty($opportunityId)) {
            throw new \InvalidArgumentException('Opportunity ID cannot be empty');
        }

        $this->opportunityId = $opportunityId;
        return $this;
    }

    public function all(array $params = []): array
    {
        return $this->get($this->opportunityId);
    }
}
