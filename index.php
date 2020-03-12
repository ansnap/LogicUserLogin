<?php include_once 'header.php'; ?>

<p class="welcome"><?= __t('Welcome to our website') ?></p>

<?php include_once 'lang-switcher.php'; ?>

<span class="form-switcher active"><?= __t('Login') ?></span> | <span class="form-switcher"><?= __t('Register') ?></span>

<form id="form-login" action="auth.php" method="post">
    <input type="hidden" name="action" value="login">

    <label for="login-username"><?= __t('Username') ?>:</label>
    <input type="text" id="login-username" name="username" required>

    <label for="login-password"><?= __t('Password') ?>:</label>
    <input type="password" id="login-password" name="password" required>

    <button type="submit"><?= __t('Login') ?></button>
</form>

<form id="form-register" action="auth.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="action" value="register">

    <p><?= __t('Please provide basic information about yourself') ?></p>

    <label for="register-username"><?= __t('Username') ?>: *</label>
    <input type="text" id="register-username" name="username" required>

    <label for="register-password"><?= __t('Password') ?>: *</label>
    <input type="password" id="register-password" name="password" required>

    <label for="name"><?= __t('Name') ?>: *</label>
    <input type="text" id="name" name="name" required>

    <label for="email"><?= __t('Email') ?>: *</label>
    <input type="email" id="email" name="email" required>

    <label><?= __t('Gender') ?>: *</label>
    <input type="radio" id="male" value="m" name="gender" required>
    <label for="male" class="radio-label"><?= __t('Male') ?></label><br>

    <input type="radio" id="female" value="f" name="gender" required>
    <label for="female" class="radio-label"><?= __t('Female') ?></label>

    <label for="birthday"><?= __t('Birthday') ?>: *</label>
    <input type="date" id="birthday" name="birthday"
           min="<?= date_create('-100 years')->format('Y-m-d') ?>" max="<?= date('Y-m-d') ?>" required>       

    <label for="phone"><?= __t('Phone') ?>: *</label>
    <input type="tel" pattern="(\+?\d[- .]*){7,13}" id="phone" name="phone" required>
    <small><?= __t('Format') ?>: +79876543210</small>

    <label for="image"><?= __t('Image') ?>:</label>
    <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/gif">

    <button type="submit"><?= __t('Register') ?></button>
</form>

<?php include_once 'footer.php'; ?>
