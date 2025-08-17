<?php

namespace App\Console\Commands;

use App\Jobs\SendLeadCreatedEmail;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Console\Command;

class TestQueue extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:test {--lead-id=} {--user-id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the queue system by dispatching a test email job';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $leadId = $this->option('lead-id');
        $userId = $this->option('user-id');

        if (!$leadId) {
            $lead = Lead::first();
            if (!$lead) {
                $this->error('No leads found in database. Please create a lead first.');
                return 1;
            }
            $leadId = $lead->id;
        } else {
            $lead = Lead::find($leadId);
            if (!$lead) {
                $this->error("Lead with ID {$leadId} not found.");
                return 1;
            }
        }

        if (!$userId) {
            $user = User::first();
            if (!$user) {
                $this->error('No users found in database.');
                return 1;
            }
            $userId = $user->id;
        } else {
            $user = User::find($userId);
            if (!$user) {
                $this->error("User with ID {$userId} not found.");
                return 1;
            }
        }

        $this->info("Dispatching test email job for Lead ID: {$leadId} to User ID: {$userId}");

        try {
            SendLeadCreatedEmail::dispatch($lead, $userId);
            $this->info('Job dispatched successfully!');
            $this->info('Check your queue worker or run: php artisan queue:work');
        } catch (\Exception $e) {
            $this->error('Failed to dispatch job: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
