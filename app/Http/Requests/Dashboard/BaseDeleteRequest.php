<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'selectedIds' => ['sometimes', 'array', 'min:1'],
            'selectedIds.*' => ['required', 'integer', 'exists:'.$this->getTable().',id'],
        ];
    }

    protected function prepareForValidation()
    {
        if (! $this->has('selectedIds')) {
            // Try to get the ID from common route parameter names
            $id = $this->route('id') ?? $this->route('product') ?? $this->route('service') ?? $this->route('project');
            if ($id) {
                $this->merge([
                    'selectedIds' => [$id],
                ]);
            }
        }
    }

    abstract protected function getTable(): string;
}
