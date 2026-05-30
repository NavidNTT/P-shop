<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $parents = [
            'کالای دیجیتال',
            'خانه و آشپزخانه',
            'مد و پوشاک',
        ];

        foreach ($parents as $parentName) {
            $parent = Category::create([
                'name' => $parentName,
                'slug' => Str::slug($parentName),
                'parent_id' => null,
            ]);

            $children = match ($parentName) {
                'کالای دیجیتال' => ['موبایل', 'لپ‌تاپ', 'هدفون'],
                'خانه و آشپزخانه' => ['ظروف', 'نظافت', 'دکوراسیون'],
                'مد و پوشاک' => ['مردانه', 'زنانه', 'کفش'],
                default => [],
            };

            foreach ($children as $childName) {
                Category::create([
                    'name' => $childName,
                    'slug' => Str::slug($childName),
                    'parent_id' => $parent->id,
                ]);
            }
        }
    }
}
