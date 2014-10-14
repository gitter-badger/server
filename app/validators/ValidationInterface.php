<?php
namespace PhotoTresor\Validators;

interface ValidationInterface {

    /**
     * @param array $data
     * @return boolean
     *
     * @throws ValidationException
     */
    public function validate(array $data);

}
