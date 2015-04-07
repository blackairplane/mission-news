<?php
/**
 * Created by PhpStorm.
 * User: jhoward
 * Date: 4/3/15
 * Time: 12:10 PM
 */

class UserTableSeeder extends Seeder {

    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 100; $i++):
            $user = User::create(array(
                'name' => $faker->firstName . " " . $faker->lastName,
                'email' => $faker->email,
                'password' => $faker->word
            ));
        endfor;
    }

}

