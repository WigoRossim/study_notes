<?php

namespace Wigo\StudyNotes\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Wigo\StudyNotes\Entities\User;
use Wigo\StudyNotes\Services\MensagensTrait;

class CadastrarUser implements RequestHandlerInterface
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
        $email = filter_var(
            $request->getParsedBody()['email'],
            FILTER_VALIDATE_EMAIL
        );
        $nome = $request->getParsedBody()['nome'];
        $password = $request->getParsedBody()['password'];

        if ($email === '' || $nome === '' || $password === '') {
            $this->defineMensagem("Preencha todos os campos", "warning");
            return new Response(301, ['Location' => '/cadastro']);
        }

        $senhaHash = password_hash($password, PASSWORD_ARGON2I);

        $newUser = new User($nome, $email, $senhaHash);
        $this->defineMensagem("Cadastro Realizado", "success");

        $this->entityManager->persist($newUser);
        $this->entityManager->flush();

        return new Response(204, ['Location' => '/login']);
    }
}
