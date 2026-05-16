<?php

namespace App\Services\Dashboard;

use App\Helper\Media;
use App\Models\Tab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class TabService
{
    /**
     * Store a new tab for the given model.
     */
    public function store(Model $model, array $data): Tab
    {
        // Get the folder path based on the model type
        $folder = $this->getTabFolder(get_class($model));

        // Handle icon upload if present
        if (isset($data['icon']) && $data['icon'] instanceof UploadedFile) {
            $data['icon'] = Media::uploadAndAttachImage($data['icon'], $folder);
        }

        // Create the tab
        return $model->tabs()->create($data);
    }

    /**
     * Update an existing tab.
     */
    public function update(Tab $tab, array $data): Tab
    {
        // Get the folder path based on the tabbable model
        $folder = $this->getTabFolder($tab->tabbable_type);

        // Handle icon upload if present
        if (isset($data['icon']) && $data['icon'] instanceof UploadedFile) {
            // Delete old icon if exists
            if ($tab->icon) {
                $this->deleteIcon($tab->icon, $folder);
            }
            $data['icon'] = Media::uploadAndAttachImage($data['icon'], $folder);
        } else {
            // Remove icon key if not uploading new one
            unset($data['icon']);
        }

        // Update the tab
        $tab->update($data);

        return $tab->fresh();
    }

    /**
     * Delete a tab and its associated icon.
     */
    public function delete(Tab $tab): bool
    {
        // Get the folder path based on the tabbable model
        $folder = $this->getTabFolder($tab->tabbable_type);

        // Delete icon if exists
        if ($tab->icon) {
            $this->deleteIcon($tab->icon, $folder);
        }

        return $tab->delete();
    }

    /**
     * Get the folder path for tabs based on the model type.
     */
    private function getTabFolder(string $modelType): string
    {
        // Extract the model name from the full class path
        // Example: App\Models\Service -> services/tabs
        $modelName = strtolower(class_basename($modelType));

        // Pluralize the model name
        $pluralName = str_ends_with($modelName, 's') ? $modelName : $modelName.'s';

        return "{$pluralName}/tabs";
    }

    /**
     * Delete icon file.
     */
    private function deleteIcon(string $fileName, string $folder): bool
    {
        try {
            Media::removeFile($folder, $fileName);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get all tabs for a model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTabsForModel(Model $model)
    {
        return $model->tabs()->ordered()->get();
    }

    /**
     * Get active tabs for a model.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getActiveTabsForModel(Model $model)
    {
        return $model->tabs()->active()->ordered()->get();
    }

    /**
     * Reorder tabs.
     */
    public function reorder(array $tabIds): void
    {
        foreach ($tabIds as $order => $tabId) {
            Tab::where('id', $tabId)->update(['order' => $order + 1]);
        }
    }
}
