<style>
    a {
        color: white;
        padding: 10px;
        background-color: black;
        text-decoration: none;
    }
</style>

<h1>Welcome to my app!</h1>

<?php

if (isset($_SESSION['notice'])) {
    echo '<p><b>' . $_SESSION['notice'] . '</b></p>';
    unset($_SESSION['notice']);
}

if (isset($_SESSION['user'])) {
    echo '<p><b>' . $_SESSION['user']->name . '</b> is logged in</p>';
}

?>

<a href="/users/signup">Signup</a>
<a href="/users/login">Login</a>
<a href="/users">List users</a>
