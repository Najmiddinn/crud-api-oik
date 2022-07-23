<?php

namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'img' => 'required|mimes:png,jpg,jpeg',
            'status' => 'integer|nullable',
            'category_id' => 'integer|nullable',
            'deleted_at' => 'datetime|nullable',
            'created_at' => 'datetime|nullable',
            'updated_at' => 'datetime|nullable',

        ];
    }
    
    // 'message' =>$validator->errors()->first(), bu faqat bitta ustunni errorini qaytaradi
    //pastdagi funksiya ichiga yoziladi
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
           
            'message' =>$validator->errors(),
            'data' => null,
        ], 422));
    }
    
    // custom messages uchun ishlatiladi
    // public function messages()
    // {
    //     return [
    //         'name.reuired' => 'A nice name is required for the post.',
    //         'status.integer' => 'status int tipiga oid bolishi kerak',
    //         'img.required' => 'Please add img for the product.',
    //     ];
    // }
    
}
