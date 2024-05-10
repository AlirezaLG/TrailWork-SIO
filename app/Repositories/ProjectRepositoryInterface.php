<?php

namespace App\Repositories;

interface ProjectRepositoryInterface
{
    public function getAll();
    public function getProjectTimes();

    public function edit($projectId);
    public function delete($projectId);
    // public function create($projects);
    public function storeDetail(array $projectDetails);
    public function update($projectId, array $newDetails);
    // public function getFulfilledLogs();
}
