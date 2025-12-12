<?php

namespace App\Domain\UseCases;

use App\Domain\Dtos\ProductDto;
use Symfony\Component\DomCrawler\Crawler;
use App\Domain\Repositories\TagRepository;
use App\Domain\Repositories\BrandRepository;
use App\Domain\Repositories\ProductRepository;
use App\Domain\Repositories\CategoryRepository;

class Parser
{
    public function __construct(
        private ProductRepository $productRepo,
        private BrandRepository $brandRepo,
        private TagRepository $tagRepo,
        private CategoryRepository $categoryRepo,
    ) {}

    public function parse(string $content): array
    {
        $crawler = new Crawler(node: $content);

        $products = [];

        $crawler->filter(
            selector: 'div.product.b-paging-product'
        )
            ->each(closure: function (Crawler $node) use (&$products): void {

                $productId = $node->attr('event-viewitem-id');

                if (!$productId) {
                    return;
                }

                $position  = $node->attr('event-viewitem-position');

                // Link glavnog proizvoda
                $linkNode = $node->filter('.b-paging-product__title a');
                $link = $linkNode->count() ? $linkNode->attr('href') : null;
                if ($link && !str_starts_with($link, 'http')) {
                    $link = "https://www.shoptok.si" . $link;
                }

                // Slika i alt/title
                $imgNode = $node->filter('.image-cont img');
                $image = $imgNode->count() ? $imgNode->attr('src') : null;
                $title = $imgNode->count() ? $imgNode->attr('title') : null;

                // Tagovi / popust
                $tags = $node->filter('.tags-list li')->each(fn(Crawler $t) => trim($t->text()));
                $discount = null;
                foreach ($tags as $tag) {
                    if (str_contains($tag, '%')) {
                        $discount = $tag;
                    }
                }

                // Marka i naziv proizvoda
                $brand = $node->filter('h3[event-viewitem-brand]')->count()
                    ? $node->filter('h3[event-viewitem-brand]')->attr('event-viewitem-brand')
                    : null;
                $name = $node->filter('h3[event-viewitem-name]')->count()
                    ? trim($node->filter('h3[event-viewitem-name]')->text())
                    : null;

                // Cijena i broj trgovina
                $priceNode = $node->filter('.b-paging-product__price');
                $price = $priceNode->count()
                    ? floatval(str_replace(',', '.', $priceNode->attr('event-viewitem-price')))
                    : null;

                $shopsNode = $node->filter('.b-paging-product__num');
                $shops = $shopsNode->count() ? trim($shopsNode->text()) : null;

                $data = [
                    'id'       => $productId,
                    'position' => $position,
                    'link'     => $link,
                    'image'    => $image,
                    'title'    => $title,
                    'brand'    => $brand,
                    'name'     => $name,
                    'tags'     => $tags,
                    'discount' => $this->clean(price: $discount),
                    'price'    => $price,
                    'shops'    => $shops,
                ];

                $products[] = ProductDto::fromArray(data: $data);
            });

        return $products;
    }

    private function clean($price): ?string
    {
        return preg_replace(pattern: '/[^0-9.]/', replacement: '', subject: $price);
    }

    public function isertData(ProductDto $dto): void
    {
        $existingProduct = $this->productRepo->findByProductId(productId: $dto->productId);
        if ($existingProduct) {
            return;
        }

        $product = $this->productRepo->save(dto: $dto);

        if ($dto->brand) {
            $brand = $this->brandRepo->findOrCreateByName(name: $dto->brand);

            $this->productRepo->attachBrand(product: $product, brandId: $brand->id);
        }

        if (!empty($dto->tags)) {
            $tags = $dto->tags ? $this->tagRepo->findOrCreateByName(tags: $dto->tags) : [];

            $this->productRepo->syncTags(product: $product, tagIds: $tags);
        }
    }

    public function setCategory(ProductDto $dto, string $categoryName): void
    {
        $product = $this->productRepo->findByProductId(productId: $dto->productId);

        if (!$product) {
            return;
        }

        $category = $this->categoryRepo->findByName(name: $categoryName);

        if (!$category) {
            return;
        }

        $this->productRepo->attachCategory(product: $product, category: $category);
    }
}
