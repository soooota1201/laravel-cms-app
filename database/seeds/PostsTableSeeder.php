<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;
use App\Tag;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = App\User::create([
          'name' => 'John Doe',
          'email' => 'john@doe.com',
          'password' => Hash::make('password')
        ]);
        $author2 = App\User::create([
          'name' => 'Jane Doe',
          'email' => 'jane@doe.com',
          'password' => Hash::make('password')
        ]);

        $category1 = Category::create([
          'name' => 'News'
        ]);

        $category2 = Category::create([
          'name' => 'Marketing'
        ]);

        $category3 = Category::create([
          'name' => 'Partnership'
        ]);

        $post1 = Post::create([
          'title' => 'Lorem Ipsum',
          'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
          'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
          'category_id' => $category1->id,
          'user_id' => $author1->id,
          'image' => 'posts/1.jpg'
        ]);

        $post2 = Post::create([
          'title' => 'It is a long established fact t',
          'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
          'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
          'category_id' => $category2->id,
          'user_id' => $author2->id,
          'image' => 'posts/2.jpg'
        ]);
        
        $post3 = Post::create([
          'title' => 'e Latin words, consectetur, from a Lore',
          'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
          'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
          'category_id' => $category3->id,
          'user_id' => $author2->id,
          'image' => 'posts/3.jpg'
        ]);
        
        $post4 = Post::create([
          'title' => '1960s with the release of Letraset sheets containing',
          'description' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
          'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
          'category_id' => $category2->id,
          'user_id' => $author2->id,
          'image' => 'posts/4.jpg'
        ]);

        $tag1 = Tag::create([
          'name' => 'job'
        ]);
        
        $tag2 = Tag::create([
          'name' => 'customers'
        ]);
        
        $tag3 = Tag::create([
          'name' => 'record'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag2->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
    }
}
