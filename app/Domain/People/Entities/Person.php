<?php

namespace App\Domain\People\Entities;

use App\Domain\Shiporders\Entities\Shiporder;
use App\Infrastructure\Factories\People\PersonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
    use HasFactory;

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
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return PersonFactory::new();
    }

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
