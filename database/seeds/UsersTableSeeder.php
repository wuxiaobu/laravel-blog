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
        DB::table('users')->delete();

        DB::table('users')->insert(array(
            0 => array(
                'id' => 1,
                'name' => 'wuxiaobu',
                'email' => 'woshilieqie@163.com',
                'password' => '$2y$10$mHewdI8KU9EtclzzEwICZe2wf6qoFK6aaB5CFOvHx7BfetFdTKNjm',   // 123456789
                'remember_token' => '',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
        ));
    }
}
