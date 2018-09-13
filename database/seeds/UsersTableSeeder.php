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
        factory(\App\Models\Db\User::class, 3)->create()->each(function ($u) {
            $u->projects()->save(factory(\App\Models\Db\Project::class)->make());
            $u->projects()->save(factory(\App\Models\Db\Project::class)->make());
            $u->projects()->save(factory(\App\Models\Db\Project::class)->make());
            $u->projects()->save(factory(\App\Models\Db\Project::class)->make());
        });
    }
}
