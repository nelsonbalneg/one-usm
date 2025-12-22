<?php

namespace App\Trait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


trait ImageUploadTrait
{
    public function uploadImage(Request $request, $input_name, $path)
    {
        if ($request->hasFile($input_name)) {
            //upload the file to the storage
            $image = $request->{$input_name};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;

            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
        }
    }

    public function uploadFile(Request $request, $input_name, $path)
    {
        if ($request->hasFile($input_name)) {

            $file = $request->file($input_name);

            // Get the original file name (without the path)
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $sanitizedFileName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalFileName);
            $fileName = 'result-template_' . $sanitizedFileName . '-' . uniqid() . '.' . $ext;

            $file->move(public_path($path), $fileName);

            return $path . '/' . $fileName;
        }

        return null; // Return null if no file is uploaded
    }

    public function uploadMultiImage(Request $request, $input_name, $path)
    {
        $imagePaths = [];
        if ($request->hasFile($input_name)) {
            //upload the file to the storage
            $images = $request->{$input_name};

            foreach ($images as $image) {
                $ext = $image->getClientOriginalExtension();
                $imageName = 'media_' . uniqid() . '.' . $ext;
                $image->move(public_path($path), $imageName);

                $imagePaths[] = $path . '/' . $imageName;
            }
            return $imagePaths;
        }
    }


    public function updateImage(Request $request, $input_name, $path, $oldPath = null)
    {
        if ($request->hasFile($input_name)) {
            //check if the file exists and delete it
            if (File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            //upload the file to the storage
            $image = $request->{$input_name};
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;

            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
        }
    }

    public function updateFile(Request $request, $input_name, $path, $oldPath = null)
    {
        //check if the file exists and delete it
        if (File::exists(public_path($oldPath))) {
            File::delete(public_path($oldPath));
        }

        if ($request->hasFile($input_name)) {

            $file = $request->file($input_name);

            // Get the original file name (without the path)
            $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $sanitizedFileName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $originalFileName);
            $fileName = 'result-template_' . $sanitizedFileName . '-' . uniqid() . '.' . $ext;

            $file->move(public_path($path), $fileName);

            return $path . '/' . $fileName;
        }

        return null; // Return null if no file is uploaded
    }

    public function deleteImage(?string $path)
    {
        // Ensure the path is not empty and check if the file exists
        if (!empty($path) && File::exists(public_path($path))) {
            // Delete the file if it exists
            File::delete(public_path($path));
        }
    }

}
