<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use PhotoTresor\Services\PhotoService;

class PhotosController extends \BaseController {

    protected $photoService;

    function __construct(PhotoService $photoService) {
        $this->beforeFilter('auth');
        $this->photoService = $photoService;
    }

    /**
     * Display a listing of the resource.
     * GET /photos
     *
     * @return Response
     */
    public function index()
    {
        if(Input::get('expand') == 'user')
        {
            $photos = $this->photoService->allWithUsers();
        } else {
            $photos = $this->photoService->all();
        }

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

                $data = [
                    'file_name' => $inputImage->getClientOriginalName(),
                    'file_size' => $inputImage->getSize(),
                    'file_mime_type' => $interventionImage->mime(),
                    'file_sha1' => $file_sha1,
                    'width' => $interventionImage->width(),
                    'height' => $interventionImage->height(),
                    'user_id' => $user_id,
                    'captured_at' => $interventionImage->exif()['DateTimeOriginal']
                ];

                $photo = $this->photoService->create($data);

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
        try
        {
            return $this->photoService->find($id);
        }
        catch (ModelNotFoundException $e)
        {
            return Response::apiError(['message' => 'Photo not found.'], 404);
        }
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
        $photo = Photo::find($id);
        $photoPath = Config::get('phototresor.storage') . "$photo->user_id/$photo->file_sha1.jpg";
        Log::debug('Delete Photo: ' . $photoPath);

        File::delete($photoPath);
        $this->photoService->delete($id);

        return Response::apiSuccess([]);
    }

}
