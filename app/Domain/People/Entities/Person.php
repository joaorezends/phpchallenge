<?php

namespace App\Domain\People\Entities;

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
     * Get all of the phones for the Person
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phones(): HasMany
    {
        return $this->hasMany(Phone::class);
    }
}
