<?php

namespace App\Infrastructure\Repositories\Shiporders;

use App\Domain\Shiporders\Entities\Item;
use App\Domain\Shiporders\Interfaces\Repositories\ItemRepository as IItemRepository;
use App\Infrastructure\Repositories\Repository;

class ItemRepository extends Repository implements IItemRepository
{
    /**
     * @return string
     */
    public function getModelClass(): string
    {
        return Item::class;
    }

    /**
     * @param  array $attributes
     * @return Item
     */
    public function store(array $attributes): Item
    {
        return $this->model->updateOrCreate($attributes, $attributes);
    }
}
