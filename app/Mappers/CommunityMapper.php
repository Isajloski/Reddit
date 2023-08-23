<?php

namespace App\Mappers;

use App\Models\Community;
use App\Models\dto\CommunityDto;

class CommunityMapper
{

    public function mapToDto(Community $community)
    {
        $communityDto = new CommunityDto($community->id, $community->name);
        return $communityDto;
    }

    public function mapCollectionToDto($communities)
    {
        return $communities->map(function ($community){
            return $this->mapToDto($community->community);
        });
    }

}
