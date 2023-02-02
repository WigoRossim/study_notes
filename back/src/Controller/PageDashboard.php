<?php

namespace Wigo\StudyNotes\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Wigo\StudyNotes\Entities\User;
use Wigo\StudyNotes\Services\RenderizaHtmlTrait;

class PageDashBoard implements RequestHandlerInterface
{
    use RenderizaHtmlTrait;

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
        $id = $_SESSION["user_id"];

        if (is_null($id) || $id === false) {
            return new Response(301, ['Location' => '/login']);
        }

        /** @var User */
        $user = $this->repositorioUsers->find($id);

        if (is_null($user) || $user === false) {
            return new Response(301, ['Location' => '/login']);
        }

        $notas = $user->notes();

        $html = $this->renderizaHtml("dashboard/dashboard.php", [
            "notas" => $notas
        ]);
        return new Response(301, [], $html);
    }
}
