<?php

class Photo extends Eloquent {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'photos';

	/**
	 * The fillable attributes of this model.
	 *
	 * @var array
	 */
	protected $fillable = array(
		'file_name',
		'file_size',
		'file_mime_type',
		'file_sha1',
		'width',
		'height',
		'user_id',
		'captured_at'
	);

}
