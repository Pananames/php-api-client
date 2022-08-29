<?php

namespace Pananames\Api\V2\Validator;

use _PHPStan_9a6ded56a\Nette\Neon\Exception;
use JsonSchema\Validator as JsonValidator;


class Validator
{
    private object $jsonSchemaObject;

    public function __construct(string $schema)
    {
        $dir = dirname(__DIR__) . '/Schemas/';
        $this->jsonSchemaObject = (object)['$ref' => 'file://' . realpath($dir . $schema . '.json')];
    }

    /**
     * @param array $data
     * @return void
     * @throws Exception
     */
    public function validate(array $data): void
    {
        $jsonValidator = new JsonValidator();

        $jsonValidator->validate($data, $this->jsonSchemaObject);
        if ($jsonValidator->isValid()) {
            return;
        } else {
            $msgErr =  "JSON does not validate. Violations: \n";
            foreach ($jsonValidator->getErrors() as $error) {
                $msgErr .= "[{$error['property']}]. {$error['message']}\n";
            }
            throw new Exception($msgErr);
        }
    }
}
