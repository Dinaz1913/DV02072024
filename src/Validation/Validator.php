<?php

namespace Reelz222z\Cryptoexchange\Validation;

class Validator
{
    public function validateLogin($email, $password)
    {
        $errors = [];

        if (empty($email)) {
            $errors[] = 'Email is required';
        }

        if (empty($password)) {
            $errors[] = 'Password is required';
        }

        return $errors;
    }

    public function validateRegistration($email, $password, $confirmPassword)
    {
        $errors = [];

        if (empty($email)) {
            $errors[] = 'Email is required';
        }

        if (empty($password)) {
            $errors[] = 'Password is required';
        }

        if ($password !== $confirmPassword) {
            $errors[] = 'Passwords do not match';
        }

        return $errors;
    }
}
