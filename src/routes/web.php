<?php

use App\Models\Chunk;
use App\Services\OllamaService;
use App\Services\RagProviderInterface;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('embed', function (RagProviderInterface $ragService) {
    $text = File::get(storage_path('app/public/sample.txt'));

    $chunks = $ragService->chunk(
        text: $text,
        chunkSize: 500
    );

    $embeddings = $ragService->embed($chunks);

    $embeddings->chunk(1)->each(function ($chunk) {
        $chunk->each(function ($item) {
            Chunk::create([
                'text' => $item['text'],
                'data' => $item['data'],
            ]);
        });
    });
});

Route::get('test', function (RagProviderInterface $oragService) {
    $question = 'Why Docker is important for a developer?';
    $searchChuks = $oragService->search(text: $question);

    $resp = $oragService->askLlm(chunks: $searchChuks, question: $question);

    return [
        'question' => $question,
        'answer' => $resp['response'],
    ];
});
