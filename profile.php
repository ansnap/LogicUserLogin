<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ./');
    exit;
}

include_once 'header.php';
require_once 'classes/User.php';

$user = User::find($_SESSION['username']);
?>

<p class="welcome"><?= __t('User profile') ?></p>

<?php include_once 'lang-switcher.php'; ?>

<table>
    <tr>
        <td><?= __t('Username') ?></td>
        <td><?= $user->username ?></td>
    </tr>
    <tr>
        <td><?= __t('Name') ?></td>
        <td><?= $user->name ?></td>
    </tr>
    <tr>
        <td><?= __t('Email') ?></td>
        <td><?= $user->email ?></td>
    </tr>
    <tr>
        <td><?= __t('Gender') ?></td>
        <td><?= $user->gender == 'm' ? __t('Male') : __t('Female') ?></td>
    </tr>
    <tr>
        <td><?= __t('Birthday') ?></td>
        <td><?= $user->birthday ?></td>
    </tr>
    <tr>
        <td><?= __t('Phone') ?></td>
        <td><?= $user->phone ?></td>
    </tr>
</table>

<?php if ($img = User::getImage($user->id)) : ?>
    <a href="<?= $img ?>">
        <img class="profile-img" src="<?= $img ?>">
    </a>
<?php endif; ?>

<p><a href="logout.php"><?= __t('Logout') ?></a></p>

<?php include_once 'footer.php'; ?>
