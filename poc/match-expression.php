<?php

class Lexer
{


    const T_SELECT = 'Select';
    const T_UPDATE = 'Update';
    const T_DELETE = 'Delete';

    public function run($type)
    {
        // After
        return match($type){
//            Lexer::T_SELECT => $this->SelectStatement(),
//            Lexer::T_UPDATE => $this->UpdateStatement(),
//            Lexer::T_DELETE => $this->DeleteStatement(),
            default => $this->syntaxError('SELECT, UPDATE or DELETE'),
        };
    }

    private function SelectStatement()
    {
        return 'Select whatever';
    }

    private function UpdateStatement()
    {
        return 'Update whatever';
    }

    private function DeleteStatement()
    {
        return 'Delete whatever';
    }

    private function syntaxError(string $string)
    {
        return throw new InvalidArgumentException(sprintf('ERROR: %s', $string));
    }
}