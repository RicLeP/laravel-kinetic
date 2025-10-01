<?php

namespace Riclep\KineticApi;

use Riclep\KineticApi\Resources\ProviderActivity;
use Riclep\KineticApi\Resources\Opportunity;
use Riclep\KineticApi\Resources\Provider;
use Riclep\KineticApi\Resources\Task;
use Riclep\KineticApi\Resources\Volunteer;

class Kinetic
{
    public Opportunity $opportunity;
    public Provider $provider;
    public ProviderActivity $providerActivity;
    public Task $tasks;
    public Volunteer $volunteer;

    public function __construct()
    {
        $client = new KineticApiClient();

        $this->opportunity = new Opportunity($client);
        $this->provider = new Provider($client);
        $this->providerActivity = new ProviderActivity($client);
        $this->tasks = new Task($client);
        $this->volunteer = new Volunteer($client);
    }

    public function opportunity(): Opportunity
    {
        return $this->opportunity;
    }

    public function provider(): Provider
    {
        return $this->provider;
    }

    public function providerActivity(): ProviderActivity
    {
        return $this->providerActivity;
    }

    public function tasks(): Task
    {
        return $this->tasks;
    }

    public function volunteer(): Volunteer
    {
        return $this->volunteer;
    }
}
