<?php

/**
 * Find, update, delete, etc.. user
 */
class User {

    public static function find($username) {
        global $pdo;

        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);

        // Вернуть объект пользователя из базы
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Возвращает путь к загруженному изображению пользователя
     */
    public static function getImage($userId) {
        $result = glob("uploads/$userId.*");

        if ($result) {
            return $result[0];
        } else {
            return '';
        }
    }

}
