<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            "name" => ['required', 'min:2'],
            "category_id" => ["required", 'numeric'],
            "price" => ['required', "digits_between:0,100000000"],
            "sale" => ['required', "digits_between:0,100"],
            "stock" => ["required", "min:0"],
            "img" => 'mimes:jpeg,jpg,png,gif|required|max:1000',
            "content" => ["required", "min:2"],
            "description" => ["required"]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => "Tên danh mục không được bỏ trống",
            'category_id.unique' => "Đã tồn tại tên danh mục",
            'price.min' => "Tên danh mục không được nhỏ hơn 2 ký tự",
            'sale.max' => "Tên danh mục không được quá 10 ký tự",
            'description.required' => "Mô tả không được bỏ trống",
            'stock.required'=>'hàng tồn kho không được bỏ trống',
            "img.required"=>"vui lòng đúng định mạng file ảnh và kích thước <1mb",
             "content.required"=>"vui lòng điền mô content",
             "description.required"=>"vui lòng không được bỏ trống mô tả"
        ];
    }
}
