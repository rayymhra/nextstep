<?php
// database/factories/CourseFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'provider' => $this->faker->company(),
            'type' => $this->faker->randomElement(['free', 'paid']),
            'description' => $this->faker->paragraph(3),
            'url' => $this->faker->url(),
            'tags' => json_encode($this->faker->words(5)),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}

// database/factories/ArticleFactory.php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition()
    {
        $title = $this->faker->sentence(6);
        
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'cover_image' => $this->faker->imageUrl(800, 400, 'business', true),
            'content' => $this->faker->paragraphs(10, true),
            'created_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }
}