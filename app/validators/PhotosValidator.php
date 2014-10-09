<?php
namespace PhotoTresor\Validators;

class PhotosValidator extends AbstractValidator {

    protected $rules = [
        'id' => 'integer',
        'file_name' => 'required',
        'file_size' => 'required|min:0',
        'file_mime_type' => 'required|in:jpg,png,bmp,gif',
        'file_sha1' => 'required|alpha_num|size:40',
        'width' => 'required|integer|min:0',
        'height' => 'required|integer|min:0',
        'user_id' => 'required|integer',
        'captured_at' => 'date'
    ];

}
