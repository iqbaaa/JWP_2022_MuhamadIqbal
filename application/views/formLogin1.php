<!DOCTYPE html>
<html lang="en">

<head>
</head>

<body>

    <div class="container">
        <h1>Login</h1>
        <p>Masuk ke Dashboard</p>

        <?php if (!empty($this->session->flashdata('message_login_error'))) : ?>
            <div class="invalid-feedback">
                <?= $this->session->flashdata('message_login_error') ?>
            </div>
        <?php endif ?>

        <form action="" method="post" style="max-width: 600px;">
            <div>
                <label for="name">Email/Username*</label>
                <input type="text" name="username" class="<?= form_error('username') ? 'invalid' : '' ?>" placeholder="Your username or email" value="<?= set_value('username') ?>" required />
                <div class="invalid-feedback">
                    <?= form_error('username') ?>
                </div>
            </div>
            <div>
                <label for="password">Password*</label>
                <input type="password" name="password" class="<?= form_error('password') ? 'invalid' : '' ?>" placeholder="Enter your password" value="<?= set_value('password') ?>" required />
                <div class="invalid-feedback">
                </div>
            </div>

            <div>
                <input type="submit" class="button button-primary" value="Login">
            </div>
        </form>
    </div>
</body>

</html>