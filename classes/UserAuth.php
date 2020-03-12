<?php

require_once 'User.php';

/**
 * Класс для регистрации и входа по логину пользователя
 */
class UserAuth {

    public function register() {
        global $pdo; // DB connection
        $errors = [];

        // Проверка имени пользователя
        $username = filter_input(INPUT_POST, 'username');

        if (!$username) {
            $errors[] = 'Username must be specified';
        } else {
            $user = User::find($username);

            if ($user) {
                $errors[] = 'Username already exists';
            }
        }

        // Пароль
        $password = filter_input(INPUT_POST, 'password');

        if (!$password) {
            $errors[] = 'Password must be specified';
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }

        // Имя
        $name = filter_input(INPUT_POST, 'name');

        if (!$name) {
            $errors[] = 'Name must be specified';
        }

        // Email
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

        if (!$email) {
            $errors[] = 'Email must be specified';
        }

        // Пол
        $gender = filter_input(INPUT_POST, 'gender');

        if ($gender != 'm' && $gender != 'f') {
            $errors[] = 'Gender must be specified';
        }

        // Дата рождения
        $birthday = filter_input(INPUT_POST, 'birthday');

        if (!$birthday) {
            $errors[] = 'Birthday must be specified';
        }

        // Телефон
        $phone = filter_input(INPUT_POST, 'phone');

        if (!$phone) {
            $errors[] = 'Phone must be specified';
        } else if (!preg_match('/^(\+?\d[- .]*){7,13}$/', $phone)) {
            $errors[] = 'Phone must be in the specified format';
        }

        if ($errors) {
            return $errors;
        } else {
            // Вставка пользователя в базу
            $stmt = $pdo->prepare(
                'INSERT INTO users (username, password, name, email, gender, birthday, phone) VALUES (?, ?, ?, ?, ?, ?, ?)'
            );
            $stmt->execute([$username, $password, $name, $email, $gender, $birthday, $phone]);

            // Загрузка изображения
            if (!empty($_FILES)) {
                $user = User::find($username); // Получение ID созданного пользователя, для наименования изображения в uploads
                $this->upload($user->id);
            }

            // Инициализация сессии
            session_start();
            $_SESSION['username'] = $username;

            return true;
        }
    }

    private function upload($userId) {
        $targetDir = 'uploads/';
        $imageExt = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $targetFile = $targetDir . $userId . '.' . $imageExt;

        // Проверка расширения изображения
        if ($imageExt != 'jpg' && $imageExt != 'png' && $imageExt != 'jpeg' && $imageExt != 'gif') {
            return;
        }

        // Действительно ли загруженный файл - изображение
        $imageSize = getimagesize($_FILES['image']['tmp_name']);

        if ($imageSize === false) {
            return;
        }

        // Сохранение загруженного изображения
        move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);

        return $targetFile;
    }

    public function login() {
        $errors = [];

        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        if (!$username || !$password) {
            $errors[] = 'Username and password must be specified';
        } else {
            $user = User::find($username);

            if (!$user) {
                $errors[] = 'User does not exist';
            } else {
                if (!password_verify($password, $user->password)) {
                    $errors[] = 'Password is incorrect';
                }
            }
        }

        if ($errors) {
            return $errors;
        } else {
            // Инициализация сессии
            session_start();
            $_SESSION['username'] = $username;

            return true;
        }
    }

}
