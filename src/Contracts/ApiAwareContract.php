<?php

namespace ForwardForce\Estated\Contracts;

interface ApiAwareContract
{
    /**
     * Get all of entity
     *
     * @return array
     */
    public function fetch(): array;
}
