<?php

namespace LifeSpikes\Controllers;

use LifeSpikes\Models\User;

class HomeController
{
    public function index(): string
    {
        return layout('master', 'index');
    }
}
