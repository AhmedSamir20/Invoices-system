<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

    public function rules()
    {
        return [
            'Product_name' => 'required|max:100',
            'section_id' => 'required|numeric|exists:sections,id',

        ];
    }
    public function messages()
    {
        return [
            'Product_name.required' =>'اسم المنتج مطلوب',
            'Product_name.max' =>'اسم يجب الا يزيد عن مئه حرف  ',
            'section_id.required' =>'اسم القسم مطلوب',
            'section_id.numeric' =>'هناك خطأ هذا يبدو انه مخالف لي نظام الوقع',
            'section_id.exists' =>'اسم القسم يجيب ان يكون موجود في جدول الاقسام',


        ];
    }
}
