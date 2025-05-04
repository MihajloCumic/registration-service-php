<?php
declare(strict_types=1);
namespace Src\config\implementations;

use Src\config\Provider;
use Src\container\Container;
use Src\validation\chain\ValidationChain;
use Src\validation\FieldValidator;
use Src\validation\strategy\impl\EmailStrategy;
use Src\validation\strategy\impl\NotBlankStrategy;
use Src\validation\strategy\impl\RequiredStrategy;
use Src\validation\strategy\impl\StringLengthStrategy;
use Src\validation\strategy\impl\StringStrategy;
use Src\validation\Validator;

class RegistrationValidatorConfig implements Provider
{
    public function configure(Container $container): Validator
    {
        $validator = new FieldValidator();
        $emailChain = (new ValidationChain())
            ->addStrategy(new RequiredStrategy())
            ->addStrategy(new StringStrategy())
            ->addStrategy(new NotBlankStrategy())
            ->addStrategy(new EmailStrategy());
        $passwordChain = (new ValidationChain())
            ->addStrategy(new RequiredStrategy())
            ->addStrategy(new StringStrategy())
            ->addStrategy(new NotBlankStrategy())
            ->addStrategy(new StringLengthStrategy(min: 8));
        $validator
            ->addValidationChain('email', $emailChain)
            ->addValidationChain('password1', $passwordChain)
            ->addValidationChain('password2', $passwordChain);
        return $validator;
    }
}