<?php

namespace App\Repositories;

use App\Borough;

class BoroughRepository
{
    public function all()
    {
        return Borough::all();
    }
}