<?php

namespace App\Model;

class User {
    
    private $user_id;

    private $user_first_name;

    private $user_last_name;

    private $user_pseudo;

    private $user_mail;

    private $user_password;
    
    private $user_fk_address;

    private $user_role;

    private $user_avatar;


    public function getUserAvatar(): ?string
    {
        return $this->user_avatar;
    }

    public function setUserAvatar($user_avatar): self
    {
        $this->user_avatar = $user_avatar;

        return $this;
    }

    public function getUserRole(): ?string
    {
        return $this->user_role;
    }
 
    public function setUserRole($user_role): self
    {
        $this->user_role = $user_role;

        return $this;
    }

    public function getUserFkAddress()
    {
        return $this->user_fk_address;
    }

    public function setUserFkAddress($user_fk_address): self
    {
        $this->user_fk_address = $user_fk_address;

        return $this;
    }

    public function getUserPassword(): ?string
    {
        return $this->user_password;
    }

    public function setUserPassword($user_password): self
    {
        $this->user_password = $user_password;

        return $this;
    }

    public function hashPassword(): void {
        $this->user_password = password_hash($this->user_password, PASSWORD_DEFAULT);
    }

    public function verifyHashPassword($user_password): ?string {
        return password_verify($user_password, $this->getUserPassword());
    }

    public function getUserLastName(): ?string
    {
        return $this->user_last_name;
    }

    public function setUserLastName($user_last_name): self
    {
        $this->user_last_name = $user_last_name;

        return $this;
    }

    public function getUserFirstName(): ?string
    {
        return $this->user_first_name;
    }

    public function setUserFirstName($user_first_name): self
    {
        $this->user_first_name = $user_first_name;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId($user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getUserPseudo(): ?string
    {
        return $this->user_pseudo;
    }

    public function setUserPseudo($user_pseudo): self
    {
        $this->user_pseudo = $user_pseudo;

        return $this;
    }
 
    public function getUserMail(): ?string
    {
        return $this->user_mail;
    }

    public function setUserMail($user_mail): self
    {
        $this->user_mail = $user_mail;

        return $this;
    }
}

?>