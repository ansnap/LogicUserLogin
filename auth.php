<?php
if (empty($_POST)) {
    exit;
}

require_once 'init.php';
require_once 'classes/UserAuth.php';

$userAuth = new UserAuth();
$action = filter_input(INPUT_POST, 'action');

if ($action === 'login') {
    $result = $userAuth->login();
} else if ($action === 'register') {
    $result = $userAuth->register();
} else {
    exit;
}

if (is_array($result)) {
    // Получен массив со списком ошибок регистрации или входа пользователя
    include_once 'header.php';
    ?>

    <h2><?= __t('Errors occurred while processing the request') ?>:</h2>

    <ul>
        <?php foreach ($result as $error) : ?>
            <li><?= __t($error) ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="javascript:history.back()"><?= __t('Go back') ?></a>

    <?php
    include_once 'footer.php';
} else {
    // Пользователь успешно зарегистрирован или авторизован
    header('Location: profile.php');
    exit;
}


