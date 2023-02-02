<?php

namespace Wigo\StudyNotes\Services;

trait RenderizaHtmlTrait
{
    public function renderizaHtml(string $caminho, array $dados): string
    {
        extract($dados);
        ob_start();
        require_once __DIR__ . "/../../views/" . $caminho;
        $html = ob_get_clean();
        return  $html;
    }
}
