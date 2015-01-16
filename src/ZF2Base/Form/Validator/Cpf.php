<?php
/*
 * ZF2Base Module (https://github.com/adaoex/zf2-base)
 * 
 * @author      Adão Gonçalves <adao@adao.eti.br>
 * @link        https://github.com/adaoex/zf2-base for the canonical source repository
 * @copyright   Copyright(c) 2015 (http://adao.eti.br)
 * @license     http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace ZF2Base\Form\Validator;

use Zend\Validator\AbstractValidator;

class Cpf extends AbstractValidator
{
    const INVALID = "CPFInvalido";

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $messageTemplates = array(
        self::INVALID        => "CPF Inválido.",
    );

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and
     * getMessages() will return an array of messages that explain why the
     * validation failed.
     *
     * @param  mixed $value
     * @return boolean
     * @throws Exception\RuntimeException If validation of $value is impossible
     */
    public function isValid($value)
    {
        $cpf = $this->trimCPF($value);
        if (!$this->respectsRegularExpression($cpf)) {
            $this->error(self::INVALID);
            return false;
        }

        if (!$this->applyingCpfRules($cpf)) {
            $this->error(self::INVALID);
            return false;
        }

        return true;
    }

    /**
     * @param $cpf
     * @return string
     */
    private function trimCPF($cpf)
    {
        $cpf = preg_replace('/[.,-]/', '', $cpf);

        return $cpf;
    }

    /**
     * @param $cpf
     * @return bool
     */
    private function respectsRegularExpression($cpf)
    {
        $regularExpression = "[0-9]{3}\\.?[0-9]{3}\\.?[0-9]{3}-?[0-9]{2}";

        if (!@ereg("^" . $regularExpression . "\$", $cpf)) {
            return false;
        }

        return true;
    }

    /**
     * @param $cpf
     * @return bool
     */
    private function applyingCpfRules($cpf)
    {
        if (
            strlen($cpf)!= 11 || $cpf == "00000000000" || $cpf == "11111111111" ||
            $cpf == "22222222222" ||  $cpf == "33333333333" || $cpf == "44444444444" ||
            $cpf == "55555555555" || $cpf == "66666666666" || $cpf == "77777777777" ||
            $cpf == "88888888888" || $cpf == "99999999999"
        ) {
            return false;
        }

        $soma = 0;
        for ($i=0; $i < 9; $i ++) {
            $soma += (int) (substr($cpf, $i, 1)) * (10 - $i);
        }

        $resto = 11 - ($soma % 11);
        if ($resto == 10 || $resto == 11) {
            $resto = 0;
        }
        if ($resto != (int) (substr($cpf, 9, 1))) {
            return false;
        }

        $soma = 0;
        for ($i = 0; $i < 10; $i ++) {
            $soma += (int) (substr($cpf, $i, 1)) * (11 - $i);
        }

        $resto = 11 - ($soma % 11);
        if ($resto == 10 || $resto == 11) {
            $resto = 0;
        }
        if ($resto != (int) (substr($cpf, 10, 1))) {
            return false;
        }

        return true;
    }
}
