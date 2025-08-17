<?php

namespace App\Jobs;

use App\Mail\LeadCreatedMail;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendLeadCreatedEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $lead;
    public $userId;
    public $tries = 3; // Maximum attempts
    public $timeout = 60; // Timeout in seconds

    /**
     * Create a new job instance.
     */
    public function __construct(Lead $lead, $userId)
    {
        $this->lead = $lead;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $user = User::find($this->userId);

            if ($user && $user->email) {
                Mail::to($user->email)->send(new LeadCreatedMail($this->lead));
                Log::info("Lead creation email sent successfully to {$user->email} for lead: {$this->lead->name}");
            } else {
                Log::warning("User not found or email missing for user ID: {$this->userId}");
            }
        } catch (\Exception $e) {
            Log::error("Failed to send lead creation email: " . $e->getMessage());
            throw $e; // Re-throw to trigger retry
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error("SendLeadCreatedEmail job failed for lead ID: {$this->lead->id}, User ID: {$this->userId}", [
            'error' => $exception->getMessage(),
            'lead' => $this->lead->toArray(),
        ]);
    }
}
