<?php

namespace App\Domain\Shiporders\Jobs;

use App\Domain\Shiporders\Interfaces\Services\ShiporderService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StoreShiporderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var array
     */
    private $attributes;

    /**
     * @var ShiporderService
     */
    private $shiporderService;

    /**
     * Create a new job instance.
     *
     * @param array $attributes
     * @return void
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
        $this->shiporderService = app()->make(ShiporderService::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->shiporderService->store($this->attributes);
    }
}
