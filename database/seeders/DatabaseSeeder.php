<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Issue;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $bugs = Issue::factory(5)->create([
            'type' => Issue::TYPE_BUG,
        ]);

        Issue::factory(5)->create([
            'type' => Issue::TYPE_TASK,
        ]);

        $comments = Comment::factory(2)->make()->toArray();
        $bugs->each(function ($bug) use ($comments) {
            $commentsCreated =$bug->comments()->createMany($comments);
            $commentsCreated->each(function ($comment) {
                $comment->comment()->saveMany(Comment::factory(2)->make());
            });
        });

    }
}
