<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PricingPlanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pricing_plan_id'    => 'nullable|exists:pricing_plans,id',
            'title'              => 'required|string|max:255',
            'icon'               => 'required|string|max:255',
            'price'              => 'required|numeric',
            'features'           => 'required|array',// Change to string if using explode() in the controller
        ];
    }

}
