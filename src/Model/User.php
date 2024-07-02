<?php

namespace Reelz222z\Cryptoexchange\Model;

class User extends BaseUser
{
    public static function findByEmail($email)
    {
        $db = Database::getDB();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            return new static($row['id'], $row['email'], $row['password']);
        }

        return null;
    }

    public function save()
    {
        $db = Database::getDB();
        if ($this->getId()) {
            $stmt = $db->prepare('UPDATE users SET email = :email, password = :password WHERE id = :id');
            $stmt->bindValue(':id', $this->getId(), \PDO::PARAM_INT);
        } else {
            $stmt = $db->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        }
        $stmt->bindValue(':email', $this->getEmail(), \PDO::PARAM_STR);
        $stmt->bindValue(':password', $this->getPassword(), \PDO::PARAM_STR);
        $stmt->execute();

        if (!$this->getId()) {
            $this->id = $db->lastInsertId();
        }
    }
}
