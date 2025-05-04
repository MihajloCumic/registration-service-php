<?php

namespace Src\repository;

interface RepositoryI
{
    public function insert(array $data): array;
    public function find(array $data): array;
}