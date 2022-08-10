<?php

namespace LifeSpikes\Controllers;

use LifeSpikes\Support\S3;
use LifeSpikes\Models\User;

class UsersController
{
    public function signup(): string
    {
        S3::upload(
            $filename = uniqid().'.png',
            file_get_contents($_FILES['picture']['tmp_name'])
        );

        $user = User::create([
            'name' => $_POST['name'],
            'picture' => $filename,
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        $_SESSION['notice'] = "User ID $user->id successfully created";
        header('Location: /');
    }

    public function login(): void
    {
        if ($user = User::findByEmail($_POST['email'])) {
            if (password_verify($_POST['password'], $user->password)) {
                $_SESSION['user'] = $user;
                $_SESSION['notice'] = 'User successfully logged in';

                header('Location: /');
                return;
            }
        }

        $_SESSION['notice'] = 'Invalid email or password';
        header('Location: /');
    }
}
