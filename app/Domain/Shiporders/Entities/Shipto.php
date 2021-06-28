<?php

namespace App\Domain\Shiporders\Entities;

use App\Infrastructure\Factories\Shiporders\ShiptoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Shipto extends Model
{
    use HasFactory;
    
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
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ShiptoFactory::new();
    }

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
