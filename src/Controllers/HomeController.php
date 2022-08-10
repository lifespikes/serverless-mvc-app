<?php

namespace LifeSpikes\Controllers;

class HomeController
{
    public function index()
    {
        return layout('master', 'index');
    }
}
