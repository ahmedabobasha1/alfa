<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use Illuminate\Database\Eloquent\Relations\Relation;

class ImagesService
{
    public function upload($images, $model, $folder)
    {
        foreach ($images as $key => $image) {

            $model->images()->create([
                'file_name' => Media::uploadAndAttachImage($image, $folder.$model->id.'/images'),
                'mediable_id' => $model->id,
                'mediable_type' => Relation::getMorphedModel($model->getMorphClass()),
                'file_type' => 'image',
                'order' => $key + 1,
            ]);
        }
    }

    public function delete($model, $image, $folder)
    {
        // Delete the image file from storage
        Media::removeFile($folder.$model->id.'/images/', $image->file_name);

        // Delete the image record from the database
        $image->delete();
    }

    public function destroyAll($model, $folder)
    {

        try {
            foreach ($model->images as $image) {

                // Delete the image file from storage
                $path = Media::removeFile($folder.$model->id.'/images/', $image->file_name);

                // Delete the image record from the database
                $image->delete();
            }

        } catch (\Exception $e) {
            // Log the exception or handle it as needed
            throw $e; // Rethrow the exception after logging
        }

    }
}
