<?php

    namespace App\Jobs;
    
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Queue\InteractsWithQueue;
    use Illuminate\Queue\SerializesModels;
    use Illuminate\Support\Facades\Mail;
    use App\Mail\UserMail;
    
    class QueueJob implements ShouldQueue
    {
        use  InteractsWithQueue, Queueable, SerializesModels;
    
        public $data;
    
        public function __construct($data)
        {
            $this->data = $data;
        }
    
        public function handle()
        {
            // Add the logic for processing the data
            // \Log::info('Processing Data: ' . $this->data);
            Mail::to('pratikpihulkar2000@gmail.com')->send(new UserMail($this->data));
        }
    }
    