<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoicesRequest extends FormRequest
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
            'invoice_number' => 'required|max:50',
            'Section' => 'required|numeric|exists:sections,id',
            'invoice_Date'=>'required|date|date_format:Y-m-d',
            'Due_date'=>'required|date|date_format:Y-m-d',
            'product'=>'required',
            'Amount_collection'=>'required',
            'Amount_Commission'=>'required',
            'Discount'=>'required',
            'Value_VAT'=>'required',
            'Rate_VAT'=>'required',
            'Total'=>'required',
            'file_name' => 'mimes:pdf,jpeg,png,jpg',

        ];
    }
    public function messages()
    {
        return [

            'product.max' =>'اسم المنتج يجب الا يتعدي 50 حرف',
            'section_id.exists' =>'اسم القسم يجيب ان يكون موجود في جدول الاقسام',
            'section_id.required' =>'اسم القسم مطلوب',
            'invoice_Date.required' =>'تاريخ الفاتورة مطلوب',
            'invoice_Date.date' =>'يجب ان تكون من نوع تاريخ',
            'Due_date.required' =>'تاريخ الاستحقاق الفاتورة مطلوب',
            'Due_date.date' =>'يجب ان تكون من نوع تاريخ',
            'product.required' =>'اسم المنتج مطلوب',
            'Amount_collection.required'=>'مبلغ التحصيل مطلوب',
            'Amount_Commission.required'=>'مبلغ العمولة مطلوب',
            'Discount.required'=>'يجيب انت تضع قيمه',
            'Value_VAT.required'=>' قيمة ضريبة القيمة المضافة مطلوبه',
            'Rate_VAT.required'=>'نسبة ضريبة القيمة المضافة مطلوبه',
            'Total.required'=>' الاجمالي شامل الضريبة مطلوبه',
            'file_name.mimes' => 'صيغة المرفق يجب ان تكون   pdf, jpeg , png , jpg',


        ];
    }
}
