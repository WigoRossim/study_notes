<?php

namespace Wigo\StudyNotes\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Wigo\StudyNotes\Entities\Note;
use Wigo\StudyNotes\Entities\User;
use Wigo\StudyNotes\Services\MensagensTrait;

class RegistrarNota implements RequestHandlerInterface
{
    use MensagensTrait;

    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $notaParseBody = $request->getParsedBody();
        $id = filter_var($_SESSION['user_id'], FILTER_VALIDATE_INT);

        if ($notaParseBody['titulo'] === '' || $notaParseBody['nivel'] === '' || $notaParseBody['descricao'] === '') {
            $this->defineMensagem("Preencha todos os campos", "warning");
            return new Response(301, ['Location' => '/dashboard']);
        }

        /**
         * @var Note $note
         */
        $note = new Note($notaParseBody['titulo'], $notaParseBody['nivel'], $notaParseBody['descricao']);
        /**
         * @var User
         */
        $user = $this->entityManager->find(User::class, $id);
        if (is_null($user)) {
            $this->defineMensagem("Usuario não encontrado", "warning");
            return new Response(301, ['Location' => '/login']);
        }

        $user->addNote($note);
        $this->entityManager->persist($user);
        $this->entityManager->persist($note);

        $this->entityManager->flush();


        $this->defineMensagem("Nota Adicionada", "success");
        return new Response(204, ['Location' => '/dashboard']);
    }
}
