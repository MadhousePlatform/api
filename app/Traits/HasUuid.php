<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait HasUuid
{
    /**
     * Create a new UUID.
     *
     * @return string
     */
    public static function createUuid(): string
    {
        return Uuid::uuid4();
    }

    /**
     * Return the UUID associated with this model.
     *
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * Update a UUID
     *
     * @param string $uuid
     * @return Model
     */
    public function setUuid(string $uuid): Model
    {
        $this->uuid = $uuid;
        return $this;
    }
}
