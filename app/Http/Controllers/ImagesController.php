<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ImageResource;
use App\Image;
use Image as Intervention;
use URL;

class ImagesController extends Controller
{

    function index () {

        $images = Image::get();

        return ImageResource::collection($images);
    }

    function showDeleted() {

        $images = Image::onlyTrashed()->get();

        return ImageResource::collection($images);
    }

    function show ($id) {
        $image = Image::find($id);

        //return ImageResource::collection($image);
        return new ImageResource($image);
    }

    function delete ($id) {

        $image = Image::destroy($id);

        if ($image) {
            $data = null;
            $status = 'success';
        } else {
            $data = $image;
            $status = 'no record found';
        }

        return response([
            'data' => $data,
            'status' => $status
        ]);
    }

    function restore ($id) {

        $image = Image::withTrashed()
            ->where('id', $id)
            ->restore();

        if ($image) {
            $data = null;
            $status = 'success';
        } else {
            $data = $image;
            $status = 'no record found';
        }

        return response([
            'data' => $data,
            'status' => $status
        ]);
    }

    function upload(Request $request) {

        $imageFile = '';

        if ($photo = $request->file('image')) {
            $imagename = $photo->getClientOriginalName();

            $destinationPath = public_path('/images');

            $optimize = Intervention::make($photo->getRealPath())
                ->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

            $optimize->save($destinationPath.'/'.$imagename,80);

            $imageFile =  URL::asset('/images/' . $imagename);
        }

        $image = new Image;
        $image->name = $request->name;
        $image->image = $imageFile;

        $image->save();

        return response([
            'data' => $image,
            'status' => 'success'
        ]);
    }

}
