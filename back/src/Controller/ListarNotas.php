<?php

namespace Wigo\StudyNotes\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Wigo\StudyNotes\Entities\User;
use Wigo\StudyNotes\Services\RenderizaHtmlTrait;

class ListarNotas implements RequestHandlerInterface
{
    use RenderizaHtmlTrait;

    /** @var EntityManagerInterface */
    private $entityManage;
    private $repositorioUser;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManage = $entityManager;
        $this->repositorioUser = $this->entityManage->getRepository(User::class);
    }


    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $user_id = filter_var($_SESSION['id'], FILTER_VALIDATE_INT);

        /** @var User */
        $user = $this->entityManage->find(User::class, $user_id);
        $notas = $user->notes();

        $html = $this->renderizaHtml('dashboard/dashboard.php', [
            'notas' => $notas,
        ]);
        return new Response(301, [], $html);
    }
}
