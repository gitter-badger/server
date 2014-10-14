<?php
namespace PhotoTresor\Validators;

use Illuminate\Validation\Factory;

class AbstractValidation implements ValidationInterface {

    protected $validator;

    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $data)
    {
        $validator = $this->validator->make($data, $this->rules);

        if($validator->fails())
        {
            throw (new ValidationException('Data is not valid.'))->setErrors($validator->messages());
        }

        return true;
    }
}