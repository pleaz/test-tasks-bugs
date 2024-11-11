<?php

use App\Models\Comment;
use App\Models\Issue;

beforeEach(function () {
    $this->issue = Issue::factory()->create(
        [
            'type' => Issue::TYPE_BUG,
        ]
    );
    $this->comment = $this->issue->comments()->create(
        Comment::factory()->make()->toArray()
    );
});

it('can create comment for bug', function () {
    $issue = Issue::factory()->create(
        [
            'type' => Issue::TYPE_BUG,
        ]
    );
    $comment = Comment::factory()->make();

    $response = $this->postJson(route('issues.comments.store', $issue),
        [
            'text' => $comment->text
        ]);

    $response->assertCreated();
    $response->assertJson([
        'data' => [
            'text' => $comment->text,
        ],
    ]);
});

it('can read comment for bug', function () {
    $response = $this->getJson(route('issues.show', $this->issue));

    $response->assertOk();
    $response->assertJson([
        'data' => [
            'comments' => [
                [
                    'text' => $this->comment->text,
                ],
            ],
        ],
    ]);
});

it('can update comment for bug', function () {
    $newComment = Comment::factory()->make();

    $response = $this->putJson(route('comments.update', $this->issue),
        [
            'text' => $newComment->text
        ]);

    $response->assertOk();
    $response->assertJson([
        'data' => [
            'text' => $newComment->text,
        ],
    ]);
});

it('can delete comment for bug', function () {
    $response = $this->deleteJson(route('comments.destroy', $this->comment));

    $response->assertNoContent();
    $this->assertSoftDeleted($this->comment);
});

it('can create reply for comment', function () {
    $newComment = Comment::factory()->make();

    $response = $this->postJson(route('comments.comments.store', $this->comment),
        [
            'text' => $newComment->text
        ]);

    $response->assertCreated();
    $response->assertJson([
        'data' => [
            'text' => $newComment->text,
        ],
    ]);
});

it('can read reply for comment', function () {
    $reply = Comment::factory()->create(
        [
            'comment_id' => $this->comment->id,
        ]
    );

    $response = $this->getJson(route('issues.show', $this->issue));

    $response->assertOk();
    $response->assertJson([
        'data' => [
            'comments' => [
                [
                    'text' => $this->comment->text,
                    'comment' => [
                        'text' => $reply->text,
                    ],
                ],
            ],
        ],
    ]);
});
