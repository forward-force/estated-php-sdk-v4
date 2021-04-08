<?php

namespace ForwardForce\Estated\Traits;

trait Parametarable
{
    /**
     * @var array
     */
    protected array $query = [];

    /**
     * @var array
     */
    protected array $bodyParams = [];

    /**
     * Add a query parameter
     *
     * @param  string $key
     * @param  $value
     * @return $this
     */
    public function addQueryParameter(string $key, $value): self
    {
        $this->query[$key] = $value;
        return $this;
    }

    /**
     * Remove a query parameter
     *
     * @param  string $key
     * @return $this
     */
    public function removeQueryParameter(string $key): self
    {
        unset($this->query[$key]);
        return $this;
    }


    /**
     * Empty query parameter array
     *
     * @return $this
     */
    public function resetQueryParameters(): self
    {
        $this->query = [];
        return $this;
    }

    /**
     * Get query string
     *
     * @return array
     */
    public function getQueryString(): array
    {
        return $this->query;
    }

    /**
     * @return array
     */
    public function getBodyParams(): array
    {
        return $this->bodyParams;
    }

    /**
     * @param array $bodyParams
     * @return self
     */
    public function setBodyParams(array $bodyParams): self
    {
        $this->bodyParams = $bodyParams;
        return $this;
    }

    /**
     * Empty body parameter array
     *
     * @return $this
     */
    public function resetBodyParameters(): self
    {
        $this->bodyParams = [];
        return $this;
    }

    /**
     * Add a body parameter
     *
     * @param  string $key
     * @param  $value
     * @return $this
     */
    public function addBodyParameter(string $key, $value): self
    {
        $this->bodyParams[$key] = $value;
        return $this;
    }
}
