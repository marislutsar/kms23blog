<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FollowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::select('id')->get();
        foreach($users as $user){
            $followers = $users->random(rand(0, $users->count()));
            foreach($followers as $follower){
                Follow::factory()->create(['follower_id' => $follower->id, 'followee_id' => $user->id]);
            }
        }
    }
}
