<?php

namespace Wigo\StudyNotes\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Wigo\StudyNotes\Entities\User;
use Wigo\StudyNotes\Services\MensagensTrait;

class LoginUser implements RequestHandlerInterface
{
    use MensagensTrait;

    /** @var EntityManagerInterface */
    private $entityManager;
    private $repositorioUsers;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repositorioUsers = $this->entityManager->getRepository(User::class);
    }
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $email = $request->getParsedBody()['email'];
        $password = $request->getParsedBody()['password'];
        $password = strip_tags($password);

        if ($email === '' || $password === '') {
            $this->defineMensagem("Preencha todos os campos", "warning");
            return new Response(301, ['Location' => '/login']);
        }

        /** @var User $user */
        $user = $this->repositorioUsers->findOneBy(['email' => $email]);

        if (is_null($user) || !$user->virificaSenha($password)) {
            $this->defineMensagem("Email ou senha inválidos", "danger");
            return new Response(301, ['Location' => '/login']);
        }

        $_SESSION['logado'] = true;
        $_SESSION['nome'] = $user->nome;
        $_SESSION['user_id'] = $user->id;

        $this->defineMensagem("Bem Vindo {$user->nome}", "success");
        return new Response(200, ['Location' => '/dashboard']);
    }
}
