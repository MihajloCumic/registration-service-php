<?php
declare(strict_types=1);
namespace Src\config\implementations;

use Src\config\Provider;
use Src\container\Container;
use Src\validation\chain\ValidationChain;
use Src\validation\orchestrator\Validator;
use Src\validation\strategy\EmailStrategy;
use Src\validation\strategy\NotBlankStrategy;
use Src\validation\strategy\RequiredStrategy;
use Src\validation\strategy\StringLengthStrategy;
use Src\validation\strategy\StringStrategy;

class RegistrationValidatorConfig implements Provider
{
    public function configure(Container $container): Validator
    {
        $validator = new Validator();
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