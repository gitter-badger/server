<?php
namespace PhotoTresor\Validators;

class UserValidator extends AbstractValidator {

    protected $rules = [
        'id' => 'integer',
        'email' => 'required|email',
        'username' => 'required|alpha_dash',
        'password' => '',
        'name_first' => '',
        'name_last' => '',
        'active' => 'required|boolean',
        'quota' => 'min:0'
    ];

}
