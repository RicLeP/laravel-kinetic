<?php

namespace Riclep\KineticApi\Resources;

use Riclep\KineticApi\Facades\Kinetic;

class Opportunity extends KineticResource
{
    protected function getResourceEndpoint(): string
    {
        return 'opps';
    }

    protected function getFilterResourceEndpoint(): string
    {
        return $this->getResourceEndpoint() . '/filter';
    }

    /**
     * Get activities for providers
     *
     * @param string|null $opportunityId Provider GUID (optional)
     * @return OpportunitySession
     */
    public function sessions(?string $opportunityId = null): OpportunitySession
    {
        if (!$opportunityId) {
            throw new \InvalidArgumentException('Opportunity ID cannot be empty');
        }

        return new OpportunitySession($this->client)->forOpportunity($opportunityId);
    }
}
