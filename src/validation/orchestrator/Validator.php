<?php
declare(strict_types=1);
namespace Src\validation\orchestrator;

use Src\validation\chain\ValidationChain;

class Validator
{
    /**
     * @var array<string, ValidationChain>
     */
    private array $validatorChains = [];
    /**
     * @var array<string, array<string>>
     */
    private array $errors = [];


    public function addValidationChain(string $fieldName, ValidationChain $chain): self
    {
        $this->validatorChains[$fieldName] = $chain;
        return $this;
    }

    public function validate(array $data): bool
    {
        $this->errors = [];
        foreach ($this->validatorChains as $fieldName => $chain){
            $value = $data[$fieldName] ?? null;
            $fieldErrors = $chain->validateAndCollect($value);
            if(!empty($fieldErrors)){
                $this->errors[$fieldName] = $fieldErrors;
            }
        }
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }


}