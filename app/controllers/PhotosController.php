<?php

class PhotosController extends \BaseController {

	function __construct() {
		$this->beforeFilter('auth');
	}

	/**
	 * Display a listing of the resource.
	 * GET /photos
	 *
	 * @return Response
	 */
	public function index()
	{
		$photos = Photo::orderBy('captured_at', 'DESC')->get();
		return Response::apiSuccess($photos);
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /photos
	 *
	 * @return Response
	 */
	public function store()
	{
		if (Input::hasFile('photo'))
		{
			$inputImage = Input::file('photo');

			if ($inputImage->isValid())
			{
				$interventionImage = Image::make($inputImage);

				$user_id =  Auth::user()->id;
				$file_sha1 = sha1_file($inputImage->getRealPath());

				$fileExists = Photo::where('user_id', '=', $user_id)->where('file_sha1', '=', $file_sha1)->count();

				if($fileExists)
					return Response::json(array('message' => 'File already exists.'), 409);

				$photo = Photo::create([
					'file_name' => $inputImage->getClientOriginalName(),
					'file_size' => $inputImage->getSize(),
					'file_mime_type' => $interventionImage->mime(),
					'file_sha1' => $file_sha1,
					'width' => $interventionImage->width(),
					'height' => $interventionImage->height(),
					'user_id' => $user_id,
					'captured_at' => $interventionImage->exif()['DateTimeOriginal']
				]);

				$file_path = Config::get('phototresor.storage') . "/$user_id/";
				$file_name = "$photo->file_sha1.jpg";
				$inputImage->move($file_path, $file_name);

				return Response::json($photo, 201);
			}
		} else {
			return Response::json(array('message' => 'No file uploaded.'), 400);
		}
	}

	/**
	 * Display the specified resource.
	 * GET /photos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Photo::find($id);
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /photos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /photos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
