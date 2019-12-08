<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = $this->fakeUsers(200);
        DB::table('users')->insert($users);

        $posts = $this->fakePosts(5000);
        DB::table('posts')->insert($posts);
    }

    private function fakeUsers(int $maxUsers)
    {
        $faker = Faker::create();

        $users = [];

        for ($i = 0; $i < $maxUsers; $i += 1)
        {
            $username = $faker->username;
            $user = [
                'id' => $i + 1,
                'name' => $username,
                'email' => $username . '@dreamnet.com',
                'password' => 'secret'
            ];

            array_push($users, $user);
        }

        return $users;
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
        $fakeUserCount = DB::table('users')->count();

        $faker = Faker::create();

        $posts = [];

        for ($i = 0; $i < $maxPosts; $i += 1)
        {
            $post = [
                'content' => $faker->realText($maxNbChars = 200, $indexSize = 2),
                'user_id' => rand(1, $fakeUserCount - 1)
            ];

            array_push($posts, $post);
        }

        return $posts;
    }
}
