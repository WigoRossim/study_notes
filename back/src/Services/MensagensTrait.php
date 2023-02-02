<?php

namespace Wigo\StudyNotes\Services;

trait MensagensTrait
{
    public function defineMensagem(string $mensagem, string $tipo): void
    {
        $_SESSION['mensagem'] = $mensagem;
        $_SESSION['tipo_mensagem'] = $tipo;
    }
}