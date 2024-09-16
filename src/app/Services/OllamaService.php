<?php

namespace App\Services;

use App\Models\Chunk;
use Cloudstudio\Ollama\Facades\Ollama;
use Illuminate\Support\Collection;

class OllamaService implements RagProviderInterface
{
    protected $embedModel = 'all-minilm:33m';
    protected $llmModel = 'llama3.1:8b';
    public function chunk(string $text, int $chunkSize = 600, int $overlapSize = 100): array
    {
        $chunks = [];
        $textLength = strlen($text);

        // Calculate where the first chunk starts and the subsequent chunks.
        for ($start = 0; $start < $textLength; $start += ($chunkSize - $overlapSize)) {
            if ($start + $chunkSize > $textLength) {
                // Get the remaining text if it's shorter than the chunk size.
                $chunks[] = substr($text, $start);
                break;
            }

            // Get the chunk from the text.
            $chunks[] = substr($text, $start, $chunkSize);
        }

        return $chunks;
    }

    public function embed(array $chunks): Collection
    {
        $embeddings = collect();
        $chunks = collect($chunks);

        $chunks->each(function ($chunk) use ($embeddings) {
            $embedding = Ollama::model($this->embedModel)->embeddings($chunk);
            $embeddings->push([
                'text' => $chunk,
                'data' => $embedding['embedding'],
            ]);
        });

        return $embeddings;
    }

    public function search(string $text): Collection
    {
        $queryVector = Ollama::model($this->embedModel)
            ->embeddings($text);

        $results = Chunk::query()
            ->select('id', 'text', 'data')
            ->selectRaw("data <=> ? as similarity", [json_encode($queryVector['embedding'])])
            ->orderBy('similarity', 'asc')
            ->limit(5)
            ->get();

        $chunks = collect();
        $results->each(function($item) use ($chunks) {
            $chunks->push($item->text);
        });

        return $chunks;
    }

    public function askLlm(Collection $chunks, string $question): array
    {
        return Ollama::agent('You are a general llm.')
            ->prompt($this->makePrompt($chunks, $question))
            ->model($this->llmModel)
            ->options(['temperature' => 0.8])
            ->stream(false)
            ->ask();
    }

    private function makePrompt(Collection $chunks, string $question) {
        $content = $chunks->implode('\n');

        $prompt = <<<PROMPT
You are a general purpose LLM and you need to try to answer the question that has been asked based on the context that
has been provided to you.

If you don't know the answer, just say I don't know.
Content: {$content} \n Question: {$question}
PROMPT;

        return $prompt;
    }
}
