<?php

namespace App\Console\Commands;

use App\Jobs\AnnotateTopPosts;
use Illuminate\Console\Command;

class AnnotateTop extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'annotate:top';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Annotate the top 25 posts on Reddit front page';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        dispatch(new AnnotateTopPosts());
    }
}
