<?php
namespace PhotoTresor\Validators;

use Exception;
use Illuminate\Support\MessageBag;

class ValidatorException extends Exception {

    /**
     * @var array
     */
    protected $errors;

    /**
     * @param MessageBag $errors
     * @return $this
     */
    public function setErrors(MessageBag $errors)
    {
        $this->errors = $errors;

        return $this;
    }

    /**
     * @return MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

}