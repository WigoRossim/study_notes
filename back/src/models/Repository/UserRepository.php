<?php

namespace Wigo\StudyNotes\Repository;

use Doctrine\ORM\EntityManager;
use Wigo\StudyNotes\Entities\Note;
use Wigo\StudyNotes\Entities\User;
use Wigo\StudyNotes\Helper\EntityManagerCreator;

class UserRepository
{
    private EntityManager $entityManager;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
    }

    public function registerUser(string $nome, string $email, string $password): void
    {
        $user = new User($nome, $email, $password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function login(string $email, string $password)
    {
        $dql = "SELECT user 
        FROM Wigo\StudyNotes\Entities\User user 
        WHERE user.email = :email 
        AND user.password = :password";

        $query = $this->entityManager->createQuery($dql);
        $query->setParameter("email", $email);
        $query->setParameter("password", $password);

        /**
         * @var User
         */
        $user = $query->getSingleResult();

        if ($user->email === $email) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['user_id'] = $user->id;
            $_SESSION['nome'] = $user->nome;
        } else {
            echo "falha ao logar";
        }
    }

    public function addNewNote(string $id, string $titulo, string $nivel, string $descricao)
    {
        $note = new Note($titulo, $nivel, $descricao);
        /**
         * @var User
         */
        $user = $this->entityManager->find(User::class, intval($id));
        $user->addNote($note);
        $this->entityManager->persist($user);
        $this->entityManager->persist($note);

        $this->entityManager->flush();
    }

    public function listNotes(int $user_id)
    {
        $user = $this->entityManager->find(User::class, $user_id);
        $lista = $user->notes();
        return $lista;
    }

    public function deleteNote(int $note_id): void
    {
        $note = $this->entityManager->find(Note::class, $note_id);

        $this->entityManager->remove($note);
        $this->entityManager->flush();
    }
}
