<?php

namespace App\Repositories;

use App\Models\Response;

class ResponseRepository extends BaseRepository
{
    public function model()
    {
        return Response::class;
    }
}