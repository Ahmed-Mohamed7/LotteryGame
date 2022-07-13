<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'Name' =>['required','string','max:255'],
            'Image' =>['required','image','mimes:jpg,png,jpeg,gif,svg','max:5048'],
            'Description'=>['required','string','max:255'],
            'Price'=>['required','numeric','min:0','max:100000'],
        ];
    }
}
