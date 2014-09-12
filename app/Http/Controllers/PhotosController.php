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
	 * Show the form for creating a new resource.
	 * GET /photos/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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

				$inputImage->move(Config::get('PhotoTresor.storage') . "/$user_id/", "$photo->file_sha1.jpg");

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
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /photos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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