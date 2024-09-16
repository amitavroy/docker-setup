<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface RagProviderInterface
{
    public function chunk(string $text, int $chunkSize, int $overlapSize): array;

    public function embed(array $chunks): Collection;

    public function search(string $text): Collection;

    public function askLlm(Collection $chunks, string $question): array;
}
