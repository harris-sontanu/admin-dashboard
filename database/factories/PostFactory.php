<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Category;
use Database\Seeders\ImageSample;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence(6);
        return [
            'category_id' => Category::inRandomOrder()->first()?->id ?? 1,
            'title' => $title,
            'slug' => Str::slug($title) . '-' . Str::random(5),
            'body' => implode($this->faker->paragraphs(7)),
            'excerpt' => $this->faker->name,
            'image_url' => $this->createImageSample(),
            'is_published' => $this->faker->boolean(80),
        ];
    }

    protected function createImageSample(): string
    {
        try {
            $randomFile = ImageSample::getRandomFile();
            $file = file_get_contents($randomFile->getPathname());

            $path = uploadFile($file, 'posts');

            return $path;
        } catch (\Throwable $th) {
            logger()->error($th);
            return $th;
        }
    }
}
