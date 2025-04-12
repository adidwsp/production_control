<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
</head>

<body>
    <h1>Register</h1>

    <?php if (session('errors')): ?>
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach ?>
        </ul>
    <?php endif; ?>

    <form action="/register" method="post">
        <?= csrf_field() ?>
        <label>Username</label><br>
        <input type="text" name="username" value="<?= old('username') ?>"><br><br>

        <label>Password</label><br>
        <input type="password" name="password"><br><br>

        <label>Confirm Password</label><br>
        <input type="password" name="pass_confirm"><br><br>

        <button type="submit">Register</button>
    </form>
</body>

</html>