<?php

use App\Models\Issue;

it('can get a list of bugs and tasks', function () {
    Issue::factory()->count(3)->create();

    $response = $this->getJson(route('issues.index'));

    $response->assertOk();
    $response->assertJsonCount(3, 'data');
    $response->assertJsonStructure([
        'data' => [
            '*' => [
                'id',
                'title',
                'description',
                'reporter',
                'tester',
                'executor',
                'status',
                'type',
            ],
        ],
    ]);
});

it('can store bug and task', function () {
    $newIssue = Issue::factory()->make();

    $response = $this->postJson(route('issues.store'), $newIssue->toArray());

    $response->assertCreated();
    $response->assertJson([
        'data' => [
            'description' => $newIssue->description
        ],
    ]);

    $this->assertDatabaseHas('issues', [
        'title' => $newIssue->title
    ]);
});

it('can change an bug status', function () {
    $issue = Issue::factory()->create(
        [
            'type' => Issue::TYPE_BUG,
            'status' => Issue::STATUS_PAUSE
        ]
    );

    $response = $this->patchJson(route('issues.update', $issue),
        [
            'title' => $issue->title,
            'description' => $issue->description,
            'reporter' => $issue->reporter,
            'tester' => $issue->tester,
            'executor' => $issue->executor,
            'type' => $issue->type,
            'status' => Issue::STATUS_TESTING,
        ]);

    $response->assertOk();
    $response->assertJson([
        'data' => [
            'status' => Issue::STATUS_TESTING,
        ],
    ]);
});

it('can change bug to task', function () {
    $issue = Issue::factory()->create(
        [
            'type' => Issue::TYPE_BUG,
        ]
    );

    $response = $this->patchJson(route('issues.update', $issue),
        [
            'title' => $issue->title,
            'description' => $issue->description,
            'reporter' => $issue->reporter,
            'tester' => $issue->tester,
            'executor' => $issue->executor,
            'type' => Issue::TYPE_TASK,
            'status' => $issue->status,
        ]);

    $response->assertOk();
    $response->assertJson([
        'data' => [
            'type' => Issue::TYPE_TASK,
        ],
    ]);
});

it('it can delete a task', function () {
    $issue = Issue::factory()->create(
        [
            'type' => Issue::TYPE_TASK
        ]
    );

    $response = $this->deleteJson(route('issues.destroy', $issue));

    $response->assertNoContent();
    $this->assertSoftDeleted('issues', ['id' => $issue->id]);
});

it('it can get a bug', function () {
    $issue = Issue::factory()->create(
        [
            'type' => Issue::TYPE_BUG
        ]
    );

    $response = $this->getJson(route('issues.show', $issue));

    $response->assertOk();
    $response->assertJson([
        'data' => [
            'title' => $issue->title,
            'type' => Issue::TYPE_BUG,
        ],
    ]);
});
