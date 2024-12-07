<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->generateTree(4);
    }

    public function generateTree($current, $parent=null){
        if($current > 0){
            $categories = Category::factory(rand($current-1, 4))->create(['parent_id' => $parent]);
            foreach($categories as $category){
                $this->generateTree($current-1, $category->id);
            }
        }
    }
}
