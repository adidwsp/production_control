<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h1>Login</h1>

    <?php if (session('error')): ?>
        <p style="color: red;"><?= esc(session('error')) ?></p>
    <?php endif; ?>

    <form action="/login" method="post">
        <?= csrf_field() ?>
        <label>Username</label><br>
        <input type="text" name="username" value="<?= old('username') ?>"><br><br>

        <label>Password</label><br>
        <input type="password" name="password"><br><br>

        <button type="submit">Login</button>
    </form>
</body>

</html>