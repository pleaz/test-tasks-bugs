<?php

namespace App\Http\Controllers;

use App\Http\Requests\IssueRequest;
use App\Http\Resources\IssueResource;
use App\Models\Issue;

class IssueController extends Controller
{
    public function index()
    {
        return IssueResource::collection(Issue::all());
    }

    public function store(IssueRequest $request)
    {
        $issue = Issue::create($request->all());

        return new IssueResource($issue);
    }

    public function update(IssueRequest $request, Issue $issue)
    {
        $issue->update($request->all());

        return new IssueResource($issue);
    }

    public function destroy(Issue $issue)
    {
        $issue->delete();

        return response()->noContent();
    }

    public function show(Issue $issue)
    {
        return new IssueResource($issue->load('comments', 'comments.comment'));
    }
}
