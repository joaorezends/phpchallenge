<?php

namespace App\Domain\Shiporders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "shiporders_items";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "title", "note", "quantity", "price", "shiporder_id",
    ];

    /**
     * Get the shiporder that owns the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function shiporder(): BelongsTo
    {
        return $this->belongsTo(Shiporder::class);
    }
}
