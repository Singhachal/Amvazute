<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🔴 Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $commentRecords = [
            [
                'user_id' => 2,
                'post_id' => 2,
                'comment' => 'This is a great post! Very informative and helpful.',
                'status' => 1, // or 'pending', 'rejected' based on your migration
            ]
        ];

        Comment::insert($commentRecords);

        // ✅ Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
