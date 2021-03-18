<?php

namespace App\Http\Controllers;

use App\Repositories\RateRepositoryInterface;
use Illuminate\Http\Request;

class RateController extends Controller
{
    private RateRepositoryInterface $rateRepository;

    public function __construct(RateRepositoryInterface  $rateRepository)
    {
        $this->rateRepository = $rateRepository;
    }

    public function store()
    {

    }
}
