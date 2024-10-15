<?php

namespace App\Utils;

abstract class AbstractController
{
   protected array $arrayError = [];
    public function redirectToRoute($route)
    {
        http_response_code(303);
        header("Location: {$route} ");
        exit;
    }

    public function isNotEmpty($value)
    {
        if (empty($_POST[$value])) {
            $this->arrayError[$value] = "Le champ $value ne peut pas être vide.";
            return $this->arrayError;
        }
        return false;
    }

    public function checkFormat($nameInput, $value)
    {
        $regexString = '/^[a-zA-Zà-üÀ-Ü -]{2,255}$/';
        $regexDescription = '/^[a-zA-Zà-üÀ-Ü0-9 #?!@$%^,.;&*-]{4,}$/';
        $regexLevel = '/^[0-9]{1,}$/';

        switch ($nameInput) {
            case 'name':
                if (!preg_match($regexString, $value)) {
                    $this->arrayError['name'] = 'Merci de renseigner un nom correcte!';
                }
                break;
            case 'type':
                if (!preg_match($regexString, $value)) {
                    $this->arrayError['type'] = 'Merci de donné un type correcte';
                }
                break;
            case 'level':
                if (!preg_match($regexLevel, $value)) {
                    $this->arrayError['level'] = 'Merci de renseigner un niveau correcte!';
                }
                break;
            case 'description':
                if (!preg_match($regexDescription, $value)) {
                    $this->arrayError['description'] = 'Merci de renseigner une description correcte!';
                }
                break;
        }
    }

    public function check($nameInput, $value)
    {
        $this->isNotEmpty($nameInput);
        $value = htmlspecialchars($value);
        $this->checkFormat($nameInput, $value);
        return $this->arrayError;
    }
}
