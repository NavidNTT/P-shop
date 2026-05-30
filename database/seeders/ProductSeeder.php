<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::factory()->count(30)->create();

        $demoDir = public_path('demo-images');
        $demoImages = File::exists($demoDir) ? File::files($demoDir) : [];

        if (empty($demoImages)) {
            return;
        }

        foreach ($products as $product) {
            $imagesCount = rand(1, 3);

            for ($i = 0; $i < $imagesCount; $i++) {
                $file = $demoImages[array_rand($demoImages)];
                $filename = uniqid('product_') . '_' . $file->getFilename();
                $targetPath = "products/{$filename}";

                Storage::disk('public')->put($targetPath, File::get($file->getPathname()));

                $product->images()->create([
                    'path' => $targetPath,
                ]);
            }
        }
    }
}
