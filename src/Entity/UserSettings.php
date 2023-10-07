<?php

declare(strict_types=1);

namespace App\Entity;

class UserSettings
{
    private string $oldPassword;
    private string $plainPassword;
    private string $confirmPassword;

    public function setOldPassword(string $password)
    {
        $this->oldPassword = $password;
    }

    public function getOldPassword(): string
    {
        return $this->oldPassword;
    }

    public function setPlainPassword(string $password)
    {
        $this->plainPassword = $password;
    }

    public function getPlainPassword(): string
    {
        return $this->plainPassword;
    }

    public function setConfirmPassword(string $confirm)
    {
        $this->confirmPassword = $confirm;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }
}
