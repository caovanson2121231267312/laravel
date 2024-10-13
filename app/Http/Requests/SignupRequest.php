<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SignupRequest extends FormRequest
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
            'username'=>'required|min:5|max:10',
            'email'=>['required', 'email'],
            'password'=>'required|confirmed'
        ];
    }
    // public function messages()
    // {
    //     return [
    //         'name.required' => "Tên danh mục không được bỏ trống",
    //         'name.unique' => "Đã tồn tại tên danh mục",
    //         'name.min' => "Tên danh mục không được nhỏ hơn 2 ký tự",
    //         'name.max' => "Tên danh mục không được quá 10 ký tự",
    //         'description.required' => "Mô tả không được bỏ trống",
    //     ];
    // }
}
