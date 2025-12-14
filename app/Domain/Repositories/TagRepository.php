<?php

namespace App\Domain\Repositories;

use App\Domain\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagRepository
{
    /**
     * @return Collection<int, Tag>
     */
    public static function all(?int $categoryId = null): Collection
    {
        return self::getTagRelationQuery(categoryId: $categoryId)->get();
    }

    /**
     * @param array $tags
     * @return Tag[]
     */
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

    /**
     * @param string $name
     * @return Tag
     */
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

    /**
     * @return \Illuminate\Database\Eloquent\Builder<Tag>
     */
    private static function getTagRelationQuery(?int $categoryId = null)
    {
        return Tag::query()
            ->withCount(relations: [
                'products as products_count' => function ($query) use ($categoryId) {
                    if ($categoryId) {
                        $query->where('category_id', $categoryId);
                    }
                }
            ])
            ->orderBy(column: 'products_count', direction: 'desc');
    }
}
