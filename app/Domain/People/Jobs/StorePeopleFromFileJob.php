<?php

namespace App\Domain\People\Jobs;

use App\Domain\People\Interfaces\Services\UploadedFileService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StorePeopleFromFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $contents;

    /**
     * @var UploadedFileService
     */
    private $uploadedFileService;

    /**
     * Create a new job instance.
     *
     * @param string $contents
     * @return void
     */
    public function __construct(string $contents)
    {
        $this->contents = $contents;
        $this->uploadedFileService = app()->make(UploadedFileService::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->uploadedFileService->store($this->contents);
    }
}
