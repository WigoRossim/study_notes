<?php

namespace Wigo\StudyNotes\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class User
{
    #[Id, GeneratedValue, Column]
    public int $id;

    #[OneToMany(
        mappedBy: "user",
        targetEntity: Note::class,
        cascade: ["persist", "remove"],
        fetch: "EAGER"
    )]
    private Collection $notes;

    public function __construct(
        #[Column]
        public readonly string $nome,
        #[Column]
        public readonly string $email,
        #[Column]
        public readonly string $password,

    ) {
        $this->notes = new ArrayCollection();
    }

    public function addNote(Note $note)
    {
        $this->notes->add($note);
        $note->setUser($this);
    }

    public function notes(): Collection
    {
        return $this->notes;
    }
}
