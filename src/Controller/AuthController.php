<?php

namespace Reelz222z\Cryptoexchange\Controller;

use Reelz222z\Cryptoexchange\Model\User;
use Reelz222z\Cryptoexchange\Session;
use Reelz222z\Cryptoexchange\Validation\Validator;

class AuthController
{
    public function login()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;

            $validator = new Validator();
            $errors = $validator->validateLogin($email, $password);

            if (empty($errors)) {
                $user = User::findByEmail($email);

                if ($user && $user->getPassword() === md5($password)) {
                    Session::start();
                    Session::set('userId', $user->getId());
                    header('Location: /dashboard');
                    exit;
                }

                $errors[] = 'Invalid email or password';
            }
        }

        return [
            'template' => 'auth/login.html.twig',
            'params' => ['errors' => $errors]
        ];
    }

    public function register()
    {
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
            $confirmPassword = $_POST['confirmPassword'] ?? null;

            $validator = new Validator();
            $errors = $validator->validateRegistration($email, $password, $confirmPassword);

            if (empty($errors)) {
                $user = new User();
                $user->setEmail($email);
                $user->setPassword(md5($password)); // Using MD5 for consistency with existing data
                $user->save();

                header('Location: /login');
                exit;
            }
        }

        return [
            'template' => 'auth/register.html.twig',
            'params' => ['errors' => $errors]
        ];
    }

    public function logout()
    {
        Session::destroy();
        header('Location: /login');
        exit;
    }
}
