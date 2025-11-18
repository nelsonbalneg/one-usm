<?php

namespace App\Trait;
use Illuminate\Http\Request;
use File;

trait ImageUploadTrait
{
    public function uploadImage(Request $request, $input_name, $path){
        if($request->hasFile( $input_name))
        {
            //upload the file to the storage
            $image = $request->{ $input_name};
            $ext = $image->getClientOriginalExtension();
            $imageName ='media_'.uniqid().'.'.$ext;

            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;
        }
    }

    public function uploadMultiImage(Request $request, $input_name, $path){
        $imagePaths =[];
        if($request->hasFile( $input_name))
        {
            //upload the file to the storage
            $images = $request->{ $input_name};

            foreach( $images as  $image){
                $ext = $image->getClientOriginalExtension();
                $imageName ='media_'.uniqid().'.'.$ext;
                $image->move(public_path($path), $imageName);

                $imagePaths[] = $path.'/'.$imageName;
            }
            return $imagePaths;
        }
    }


    public function updateImage(Request $request, $input_name, $path, $oldPath=null){
        if($request->hasFile( $input_name))
        {
            //check if the file exists and delete it
            if( File::exists(public_path($oldPath)))
            {
                 File::delete(public_path($oldPath));
            }

            //upload the file to the storage
            $image = $request->{ $input_name};
            $ext = $image->getClientOriginalExtension();
            $imageName ='media_'.uniqid().'.'.$ext;

            $image->move(public_path($path), $imageName);

            return $path.'/'.$imageName;
        }
    }

    public function deleteImage(string $path){
        if( File::exists(public_path($path)))
            {
                 File::delete(public_path($path));
            }
    }

}
