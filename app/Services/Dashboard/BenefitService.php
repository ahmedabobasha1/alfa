<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\Benefit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class BenefitService
{
    /**
     * Store a new benefit for the given model.
     */
    public function store(?Model $model, array $data): Benefit
    {
        // Get the folder path based on the model type
        $folder = $this->getBenefitFolder($model ? get_class($model) : null);

        // Handle image upload if present
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            $data['image'] = Media::uploadAndAttachImage($data['image'], $folder);
        }

        // Handle icon upload if present
        if (isset($data['icon']) && $data['icon'] instanceof UploadedFile) {
            $data['icon'] = Media::uploadAndAttachImage($data['icon'], $folder);
        }

        // Create the benefit
        if ($model) {
            return $model->benefits()->create($data);
        } else {
            // Create a general benefit (not attached to any model)
            return Benefit::create($data);
        }
    }

    /**
     * Update an existing benefit.
     */
    public function update(Benefit $benefit, array $data): Benefit
    {
        // Get the folder path based on the benefitable model
        $folder = $this->getBenefitFolder($benefit->benefitable_type);

        // Handle image upload if present
        if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
            // Delete old image if exists
            if ($benefit->image) {
                $this->deleteFile($benefit->image, $folder);
            }
            $data['image'] = Media::uploadAndAttachImage($data['image'], $folder);
        } else {
            // Remove image key if not uploading new one
            unset($data['image']);
        }

        // Handle icon upload if present
        if (isset($data['icon']) && $data['icon'] instanceof UploadedFile) {
            // Delete old icon if exists
            if ($benefit->icon) {
                $this->deleteFile($benefit->icon, $folder);
            }
            $data['icon'] = Media::uploadAndAttachImage($data['icon'], $folder);
        } else {
            // Remove icon key if not uploading new one
            unset($data['icon']);
        }

        // Update the benefit
        $benefit->update($data);

        return $benefit->fresh();
    }

    /**
     * Delete a benefit and its associated files.
     */
    public function delete(Benefit $benefit): bool
    {
        // Get the folder path based on the benefitable model
        $folder = $this->getBenefitFolder($benefit->benefitable_type);

        // Delete image if exists
        if ($benefit->image) {
            $this->deleteFile($benefit->image, $folder);
        }

        // Delete icon if exists
        if ($benefit->icon) {
            $this->deleteFile($benefit->icon, $folder);
        }

        return $benefit->delete();
    }

    /**
     * Get the folder path for benefits based on the model type.
     */
    private function getBenefitFolder(?string $modelType): string
    {
        // Handle general benefits (no model association)
        if (! $modelType) {
            return 'benefits';
        }

        // Extract the model name from the full class path
        // Example: App\Models\Service -> services/benefits
        $modelName = strtolower(class_basename($modelType));

        // Pluralize the model name
        $pluralName = str_ends_with($modelName, 's') ? $modelName : $modelName.'s';

        return "{$pluralName}/benefits";
    }

    /**
     * Delete file.
     */
    private function deleteFile(string $fileName, string $folder): bool
    {
        try {
            Media::removeFile($folder, $fileName);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get all benefits for a model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getBenefitsForModel(Model $model)
    {
        return $model->benefits()->orderBy('order')->get();
    }

    /**
     * Get active benefits for a model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveBenefitsForModel(Model $model)
    {
        return $model->benefits()->active()->orderBy('order')->get();
    }

    /**
     * Reorder benefits.
     */
    public function reorder(array $benefitIds): void
    {
        foreach ($benefitIds as $order => $benefitId) {
            Benefit::where('id', $benefitId)->update(['order' => $order + 1]);
        }
    }
}
