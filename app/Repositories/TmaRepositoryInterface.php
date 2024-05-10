<?php

namespace App\Repositories;

interface TmaRepositoryInterface
{
    public function getAll();
    public function getById($logId);
    public function delete($logId);
    public function create();
    public function edit($logId);
    public function storeDetail(array $logDetails);
    public function update($logId, array $newDetails);
    // public function getFulfilledLogs();
}
