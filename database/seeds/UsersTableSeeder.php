<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [];
        $faker = Faker\Factory::create();
        
        for($i=0;$i<5;$i++){

            // $avatar_path = public_path('avatars');
            // $avatar_fullpath = $faker->image( $avatar_path, 200, 250,'people', true, true, 'people');
            // $avatar = str_replace($avatar_path . '/' , '', $avatar_fullpath);
           

            $users[$i] = [

                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('123456'),
                'roles' => json_encode(['CUSTOMER']),
                'avatar' => $faker->image('public/storage/images/users',400,300, null, false),
                'status' => 'ACTIVE',
                'created_at' => Carbon\Carbon::now(),
            ];
        }

        DB::table('users')->insert($users);
        // dst
           
    }
}
