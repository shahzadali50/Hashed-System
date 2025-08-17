# Queue Job System for Lead Email Notifications

This system uses Laravel's queue system to send lead creation emails in the background, improving performance and user experience.

## 🚀 How It Works

1. **Lead Creation**: When a lead is created, the system dispatches a `SendLeadCreatedEmail` job
2. **Background Processing**: The job runs in the queue (background) instead of blocking the user
3. **Email Sending**: The job sends the email to the assigned user
4. **Error Handling**: Failed jobs are logged and can be retried

## 📁 Files Created

- `app/Jobs/SendLeadCreatedEmail.php` - The main job class
- `app/Console/Commands/TestQueue.php` - Command to test the queue system

## ⚙️ Configuration

### Queue Driver
Your system is configured to use the **database** queue driver by default. This means:
- Jobs are stored in the `jobs` table
- Failed jobs are stored in the `failed_jobs` table
- No additional services (Redis, etc.) required

### Environment Variables
Make sure your `.env` file has:
```env
QUEUE_CONNECTION=database
```

## 🔧 Usage

### 1. Start Queue Worker
To process jobs, you need to run the queue worker:

```bash
# Process jobs continuously
php artisan queue:work

# Process jobs once and exit
php artisan queue:work --once

# Process jobs with specific queue
php artisan queue:work --queue=default

# Process jobs with timeout
php artisan queue:work --timeout=60
```

### 2. Test the Queue System
Use the test command to verify everything works:

```bash
# Test with first lead and user
php artisan queue:test

# Test with specific lead and user
php artisan queue:test --lead-id=1 --user-id=1
```

### 3. Monitor Jobs
Check job status in the database:
```sql
-- View pending jobs
SELECT * FROM jobs;

-- View failed jobs
SELECT * FROM failed_jobs;
```

## 📧 Job Features

### Retry Logic
- **Maximum Attempts**: 3 retries
- **Timeout**: 60 seconds per attempt
- **Automatic Retry**: Failed jobs are automatically retried

### Error Handling
- **Logging**: All actions are logged
- **Failure Handling**: Failed jobs are logged with details
- **Graceful Degradation**: Email failures don't affect lead creation

### Performance
- **Background Processing**: Emails don't block the UI
- **Queue Management**: Jobs can be prioritized and delayed
- **Scalability**: Multiple workers can process jobs

## 🛠️ Commands

### Queue Management
```bash
# Start queue worker
php artisan queue:work

# Check queue status
php artisan queue:monitor

# Clear all jobs
php artisan queue:clear

# Retry failed jobs
php artisan queue:retry all

# List failed jobs
php artisan queue:failed
```

### Job Testing
```bash
# Test queue system
php artisan queue:test

# Test with specific parameters
php artisan queue:test --lead-id=5 --user-id=3
```

## 📊 Monitoring

### Check Job Status
```bash
# View pending jobs count
php artisan queue:size

# View failed jobs
php artisan queue:failed
```

### Database Tables
- `jobs` - Pending and processing jobs
- `failed_jobs` - Failed jobs with error details
- `job_batches` - Job batch information (if using batching)

## 🚨 Troubleshooting

### Common Issues

1. **Jobs Not Processing**
   - Check if queue worker is running: `php artisan queue:work`
   - Verify queue driver in `.env`: `QUEUE_CONNECTION=database`

2. **Emails Not Sending**
   - Check failed jobs: `php artisan queue:failed`
   - Verify mail configuration in `.env`
   - Check logs: `storage/logs/laravel.log`

3. **Queue Worker Stops**
   - Use supervisor for production (recommended)
   - Check for memory/timeout issues
   - Monitor system resources

### Production Setup

For production, use supervisor to keep queue workers running:

```bash
# Install supervisor
sudo apt-get install supervisor

# Create configuration file
sudo nano /etc/supervisor/conf.d/laravel-worker.conf
```

Example supervisor config:
```ini
[program:laravel-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/your/project/artisan queue:work --sleep=3 --tries=3
autostart=true
autorestart=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/your/project/storage/logs/worker.log
```

## 🔄 Job Lifecycle

1. **Dispatch**: Job is created and added to queue
2. **Queue**: Job waits in database queue
3. **Processing**: Worker picks up and processes job
4. **Execution**: Email is sent
5. **Completion**: Job is removed from queue
6. **Failure**: If failed, job is moved to failed_jobs table

## 📈 Benefits

- **Better Performance**: Lead creation is faster (no email delay)
- **Reliability**: Failed emails don't affect lead creation
- **Scalability**: Multiple workers can handle high email volume
- **Monitoring**: Easy to track and debug email issues
- **Retry Logic**: Automatic retry for temporary failures

## 🎯 Next Steps

1. **Start Queue Worker**: `php artisan queue:work`
2. **Test System**: `php artisan queue:test`
3. **Monitor Jobs**: Check database tables and logs
4. **Production Setup**: Configure supervisor for production
