<?php

namespace App\Domain\Shiporders\Entities;

use App\Domain\People\Entities\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shiporder extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id", "person_id",
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        "items"
    ];

    /**
     * Get the person that owns the Shiporder
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * Get the shipto associated with the Shiporder
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function shipto(): HasOne
    {
        return $this->hasOne(Shipto::class);
    }

    /**
     * Get all of the items for the Shiporder
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}
