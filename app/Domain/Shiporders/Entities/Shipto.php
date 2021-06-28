<?php

namespace App\Domain\Shiporders\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipto extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "shiporders_shiptos";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name", "address", "city", "country", "shiporder_id",
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
