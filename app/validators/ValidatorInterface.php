<?php
namespace PhotoTresor\Validators;

interface ValidatorInterface {

    /**
     * @param array $data
     * @return boolean
     *
     * @throws ValidatorException
     */
    public function validate(array $data);

}
