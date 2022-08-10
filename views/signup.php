<style>
    form div {
        margin-bottom: 1rem;
    }

    form div label {
        font-weight: bold;
        display: block;
        margin-bottom: 2px;
    }
</style>

<h1>Sign Up</h1>

<form action="/users" method="POST" enctype="multipart/form-data">
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
    </div>

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>

    <div>
        <label for='picture'>Profile Picture</label>
        <input type='file' name='picture' id='picture'>
    </div>

    <div>
        <button type="submit">Create</button>
    </div>
</form>
