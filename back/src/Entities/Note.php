<?php

namespace Wigo\StudyNotes\Entities;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class Note
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[ManyToOne(targetEntity: User::class, inversedBy: "notes")]
    private User $user;

    public function __construct(
        #[Column]
        public readonly string $titulo,
        #[Column]
        public readonly string $nivel,
        #[Column]
        public readonly string $descricao
    ) {
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }
}
