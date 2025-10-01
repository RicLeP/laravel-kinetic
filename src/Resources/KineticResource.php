<?php

namespace Riclep\KineticApi\Resources;

use Riclep\KineticApi\KineticApiClient;

abstract class KineticResource
{
    protected KineticApiClient $client;
    protected ?int $page = null;
    protected ?int $rows = null;
    protected bool $fetchAll = false;

    // Each resource must define its endpoint
    abstract protected function getResourceEndpoint(): string;
    abstract protected function getFilterResourceEndpoint(): string;

    public function __construct(KineticApiClient $client)
    {
        $this->client = $client;
    }

    public function get($id): array
    {
        return $this->client->get($this->getResourceEndpoint() . "/{$id}");
    }

    /**
     * Get resources with pagination support
     *
     * @param array $params Additional parameters
     * @return array
     */
    public function all(array $params = []): array
    {
        // If fetchAll is true, retrieve all pages
        if ($this->fetchAll) {
            return $this->getAllPages($params);
        }

        // Apply pagination parameters if set
        if (!is_null($this->page)) {
            $params['page'] = $this->page;
        }

        if (!is_null($this->rows)) {
            $params['rows'] = $this->rows;
        }

        // Reset pagination parameters after use
        $result = $this->client->get(empty($params) ? $this->getResourceEndpoint() : $this->getFilterResourceEndpoint(), $params);
        $this->resetPagination();

        return $result;
    }

    /**
     * Set the page for pagination
     *
     * @param int $page
     * @return $this
     */
    public function page(int $page): self
    {
        $this->page = $page;
        return $this;
    }

    /**
     * Set the number of rows per page
     *
     * @param int $rows
     * @return $this
     */
    public function rows(int $rows): self
    {
        $this->rows = $rows;
        return $this;
    }

    /**
     * Fetch all available resources across all pages
     *
     * @return $this
     */
    public function fetchAll(): self
    {
        $this->fetchAll = true;
        return $this;
    }

    /**
     * Reset pagination parameters
     */
    protected function resetPagination(): void
    {
        $this->page = null;
        $this->rows = null;
        $this->fetchAll = false;
    }

    /**
     * Get all pages of resources
     *
     * @param array $params Additional parameters
     * @return array
     */
    protected function getAllPages(array $params = []): array
    {
        $allResources = [];
        $currentPage = 0;
        $rowsPerPage = $this->rows ?? 500;
        $hasMoreData = true;

        $params['rows'] = $rowsPerPage;

        while ($hasMoreData) {
            $params['page'] = $currentPage;
            $results = $this->client->get($this->getResourceEndpoint(), $params);

            if (empty($results)) {
                $hasMoreData = false;
            } else {
                $allResources = array_merge($allResources, $results);
                $currentPage++;

                if (count($results) < $rowsPerPage) {
                    $hasMoreData = false;
                }
            }
        }

        $this->resetPagination();
        return $allResources;
    }
}
