<?php

namespace App\Domain\People\Entities;

use App\Domain\Shiporders\Entities\Shiporder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "people";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id", "name",
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        "phones"
    ];

    /**
     * Get all of the phones for the Person
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }

    /**
     * Get all of the shiporders for the Person
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function shiporders(): HasMany
    {
        return $this->hasMany(Shiporder::class);
    }
}
