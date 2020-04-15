<?php

namespace App\Manager;

use App\Model\User;
use App\Manager\Exception\NotFoundException;
use PDO;

class UserManager extends Manager {

    protected $table = "user";
    protected $class = User::class;


    public function findByEmail(?string $email): ?User {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE user_mail = :user_mail");
        $query->execute([":user_mail" => $email]);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->class);
        $result = $query->fetch();
        if ($result === false) {
            throw new NotFoundException($this->table, $email);
        }
        return $result;
    }

    // public function updatePost(Post $post): void {
    //     $this->update([
    //             "name" => e($post->getName()),
    //             "slug" => e($post->getSlug()),
    //             "content" => e($post->getContent()),
    //             "created_at" => $post->getCreatedAt()->format("Y-m-d H:i:s"),
    //             "image" => $post->getImage()
    //         ], $post->getId());
    // }

    // public function createPost(Post $post): void {
    //     $id = $this->create([
    //             "name" => e($post->getName()),
    //             "slug" => e($post->getSlug()),
    //             "content" => e($post->getContent()),
    //             "created_at" => $post->getCreatedAt()->format("Y-m-d H:i:s"),
    //             "image" => $post->getImage(),
    //     ]);
    //     $post->setId($id);
    // }
}

?>