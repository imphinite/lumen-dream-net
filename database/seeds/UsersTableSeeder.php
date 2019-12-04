<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert(
            [
                'id' => 1,
                'name' => 'admin', 
                'email' => 'admin@dreamnet.com',
                'password' => 'secret'
            ]
        );

        $maxPosts = 5;

        $posts = $this->fakePosts($maxPosts);

        DB::table('posts')->insert($posts);
    }

    /**
     * Generate fake posts.
     * 
     * @param int $maxPosts
     * 
     * @return array $posts
     */
    private function fakePosts(int $maxPosts)
    {
        $faker = Faker::create();

        $posts = [];

        for ($i = 0; $i < $maxPosts; $i += 1)
        {
            $post = [
                'content' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'user_id' => 1
            ];

            array_push($posts, $post);
        }

        return $posts;
    }
}
