<?php

namespace App\Models;

use App\Helpers\HasForeignAttributes;

trait ModelAttribute
{
    use HasForeignAttributes;

    /**
     * @param  array  $attributes
     * @return void
     */
    protected function afterCreated(array $attributes)
    {
    }

    /**
     * @param  array  $attributes
     * @return void
     */
    protected function afterUpdated(array $attributes)
    {
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public static function create(array $attributes)
    {
        $instance = parent::query()->create($attributes);
        $instance->afterCreated($attributes);
        return $instance;
    }

    /**
     * Update records in the database.
     *
     * @param  array  $attributes
     * @param  array  $options
     * @return int
     */
    public function update(array $attributes = [], array $options = [])
    {
        $count = parent::update($attributes, $options);
        $this->afterUpdated($attributes);
        return $count;
    }

    /**
     * Update the model in the database within a transaction.
     *
     * @param  array  $attributes
     * @param  array  $options
     * @return bool
     *
     * @throws \Throwable
     */
    public function updateOrFail(array $attributes = [], array $options = [])
    {
        $count = parent::updateOrFail($attributes, $options);
        $this->afterUpdated($attributes);
        return $count;
    }
}
