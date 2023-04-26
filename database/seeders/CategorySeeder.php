<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category' => 'アニメーション',
        ]);
        Category::create([
            'category' => 'css設計',
        ]);
        Category::create([
            'category' => 'テンプレート',
        ]);
        Category::create([
            'category' => 'アクセシビリティ',
        ]);
        Category::create([
            'category' => 'HTML',
        ]);
        Category::create([
            'category' => 'CSS',
        ]);
        Category::create([
            'category' => 'JavaScript',
        ]);
        Category::create([
            'category' => 'Sass',
        ]);
        Category::create([
            'category' => 'Scss',
        ]);
        Category::create([
            'category' => 'tailwindcss',
        ]);
        Category::create([
            'category' => 'レスポンシブ',
        ]);
        Category::create([
            'category' => 'jQuery',
        ]);
        Category::create([
            'category' => 'object-oriented',
        ]);
        Category::create([
            'category' => 'app',
        ]);
        Category::create([
            'category' => 'tools',
        ]);
        Category::create([
            'category' => 'design',
        ]);
        Category::create([
            'category' => 'canvas',
        ]);
        Category::create([
            'category' => 'DOM',
        ]);
        Category::create([
            'category' => 'graphic',
        ]);
        Category::timestamps(true);
    }
}
