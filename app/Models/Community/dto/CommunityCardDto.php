<?php

namespace App\Models\Community\dto;

class CommunityCardDto
{
    public int $id;
    public string $name;
    public string $about;
    public string $rules;
    public int $activeUsers;
    public int $totalUsers;
    public array $flairs;

    public function __construct(){}
}
