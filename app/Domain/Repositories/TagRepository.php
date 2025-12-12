<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Tag;

class TagRepository
{

    public function findOrCreateByName(array $tags): array
    {
        if (empty($tags)) {
            return [];
        }

        $createdTags = [];
        foreach ($tags as $tagDto) {

            if (preg_match('/\d+\s*%/', $tagDto->name)) {
                continue;
            }

            $tag = $this->findOrCreate($tagDto->name);

            $createdTags[] = $tag;
        }

        return $createdTags;
    }

    private function findOrCreate(string $name): Tag
    {
        $tag = Tag::where(column: 'name', operator: $name)->first();

        if (!$tag) {
            $tag = Tag::create(
                attributes: [
                    'name' => $name,
                ]
            );
        }

        return $tag;
    }
}
