<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        $this->call('CommentTableSeeder');
        $this->call('LinkTableSeeder');
        $this->call('UserTableSeeder');
        $this->call('VoteTableSeeder');
	}

}

class CommentTableSeeder extends Seeder {

    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++):
            $comment = \App\Comment::create(array(
                'text' => $faker->paragraph(),
                'link_id' => rand(1,100),
                'user_id' => rand(1,100)
            ));
        endfor;
    }

}

class UserTableSeeder extends Seeder {

    public function run()
    {
        $user = \App\User::create(array(
            'name' => 'Test User',
            'username' => 'testuser',
            'email' => 'test@example.com',
            'password' => 'test123'
        ));

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 99; $i++):
            $user = \App\User::create(array(
                'name' => $faker->firstName . " " . $faker->lastName,
                'username' => $faker->userName,
                'email' => $faker->email,
                'password' => $faker->word
            ));
        endfor;
    }

}

class VoteTableSeeder extends Seeder {

    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++):
            $vote = \App\Vote::create(array(
                'direction' => 1,
                'link_id' => rand(1,100),
                'user_id' => rand(1,100)
            ));
        endfor;
    }

}



class LinkTableSeeder extends Seeder {

    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++):
            $link = \App\Link::create(array(
                'title' => $faker->sentence(),
                'url' => $faker->url,
                'user_id' => rand(1,100)
            ));
        endfor;
    }

}


