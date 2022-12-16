<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*if(auth()->user()->id == $this->$vehicle){
            return true;
        }*/
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nickname' => 'max:50',
            'brand' => 'required|max:50',
            'model' => 'required|max:50',
            'version' => 'required|max:50',
            'type' => 'required|max:50'
        ];
    }
}