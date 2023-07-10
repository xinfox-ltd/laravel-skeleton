<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Output\Output;

class OpenAI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'openai:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $OPENAI_API_KEY = "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";
        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer $OPENAI_API_KEY"
        ])->timeout(30)->connectTimeout(30)->post(
            'https://api.openai.com/v1/chat/completions',
            [
                'messages' => [
                    ['role' => 'user', 'content' => 'Hello, ChatGPT!']
                ],
                'model' => "gpt-3.5-turbo",
            ]
        );

        var_dump($response->body());
    }
}
