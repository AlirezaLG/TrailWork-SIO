<?php

namespace App\Repositories\Eloquent;

use App\Models\Tma;
use App\Models\Project;

use App\Repositories\TmaRepositoryInterface;
use Illuminate\Support\Collection;


class TmaRepository implements TmaRepositoryInterface
{
    protected $model;

    public function __construct(Tma $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return Tma::with(['user', 'project'])->latest()->get();
    }

    public function getById($logId)
    {
        return Tma::findOrFail($logId);
    }

    public function delete($logId)
    {
        $tma = Tma::findOrFail($logId);
        $tma->delete();
    }

    public function create()
    {
        return Project::all();
    }
    public function edit($logId)
    {
        $tma = Tma::findOrFail($logId);
        $projects = Project::all();
        return [$tma, $projects];
    }

    public function storeDetail(array $logDetails)
    {
        return Tma::create($logDetails);
    }

    public function update($logId, array $newDetails)
    {
        Tma::whereId($logId)->update($newDetails);
    }
}
