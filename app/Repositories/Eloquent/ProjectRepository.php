<?php

namespace App\Repositories\Eloquent;

use App\Models\Project;
use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Support\Collection;


class ProjectRepository implements ProjectRepositoryInterface
{
    protected $model;

    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return Project::latest()->get();
    }



    public function getProjectTimes()
    {
        return Project::with("tmas")->latest()->get();
    }

    public function edit($projectId)
    {
        return Project::findOrFail($projectId);
    }

    public function delete($projectId)
    {
        $project = Project::findOrFail($projectId);
        $project->delete();
    }



    public function storeDetail(array $projectDetails)
    {
        return Project::create($projectDetails);
    }

    public function update($projectId, array $newDetails)
    {
        return Project::whereId($projectId)->update($newDetails);
    }
}
