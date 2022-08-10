<?php

namespace LifeSpikes\Controllers;

use LifeSpikes\Support\S3;
use LifeSpikes\Models\User;

class UsersController
{
    public function index(): string
    {
        return layout('master', 'users');
    }

    public function create(): string
    {
        return layout('master', 'signup');
    }

    public function store(): string
    {
        S3::upload(
            $filename = uniqid().'.png',
            file_get_contents($_FILES['picture']['tmp_name'])
        );

        $user = User::create([
            'name' => $_POST['name'],
            'picture' => $filename,
            'email' => $_POST['email']
        ]);

        return layout('master', 'new_user', [
           'user' => $user
        ]);
    }
}
