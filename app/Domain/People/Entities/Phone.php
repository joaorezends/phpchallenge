<?php

namespace App\Domain\People\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Phone extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "people_phones";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "id", "number", "person_id",
    ];

    /**
     * Get the person that owns the Phone
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
