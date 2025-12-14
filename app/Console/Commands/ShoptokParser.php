<?php

namespace App\Console\Commands;

use App\Domain\Models\Category;
use App\Domain\UseCases\Parser;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ShoptokParser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shoptok:parser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse Shoptok page to extract relevant data';

    /**
     * Execute the console command.
     */
    public function handle(
        Parser $parser
    ): void {
        $files = Storage::files(directory: 'shoptok/data');

        if (empty($files)) {
            $this->info(string: 'No files found.');
            return;
        }

        foreach ($files as $file) {
            $this->line(string: '------------- ' . basename(path: $file) . ' -------------------------------------');

            $content = Storage::disk(name: 'local')->get(path: $file);

            $products = $parser->parse(content: $content);

            foreach ($products as $product) {
                $parser->isertData(dto: $product);
            }
        }

        Category::updateOrCreate(
            attributes: [
                'name' => 'LED TV',
                'prefix' => 'led',
                'image' => 'https://img.ep-cdn.com/i/800/345/9a/9ac2cf1b62252cat_108/led-tv-akcija.webp'
            ]
        );
        Category::updateOrCreate(
            attributes: [
                'name' => 'OLED TV',
                'prefix' => 'oled',
                'image' => 'https://img.ep-cdn.com/i/800/345/9a/9ac2cf1b62252cat_1791/oled-tv-akcija.webp'
            ]
        );

        $ledFiles = Storage::files(directory: 'shoptok/category/led');

        foreach ($ledFiles as $ledFile) {
            $this->line(string: '------------- ' . basename(path: $ledFile) . ' -------------------------------------');

            $content = Storage::disk(name: 'local')->get(path: $ledFile);

            $articles = $parser->parse(content: $content);

            foreach ($articles as $a) {
                $parser->setCategory(dto: $a, categoryName: 'LED TV');
            }
        }

        $oledFiles = Storage::files(directory: 'shoptok/category/oled');

        foreach ($oledFiles as $oledFile) {
            $this->line(string: '------------- ' . basename(path: $oledFile) . ' -------------------------------------');

            $content = Storage::disk(name: 'local')->get(path: $oledFile);

            $articles = $parser->parse(content: $content);

            foreach ($articles as $a) {
                $parser->setCategory(dto: $a, categoryName: 'OLED TV');
            }
        }
    }
}
