<?php

namespace Wigo\StudyNotes\Controller;

use Nyholm\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Wigo\StudyNotes\Services\RenderizaHtmlTrait;

class PageLogin implements RequestHandlerInterface
{
    use RenderizaHtmlTrait;

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $html = $this->renderizaHtml('login/login.php', [
            'loginStyle.css',
            'globalStyle.css'
        ], []);
        return new Response(301, [], $html);
    }
}
