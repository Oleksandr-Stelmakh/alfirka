<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [

            'name' => [
                'required',
                'string',
                'min:2',
                'max:100',
            ],

            'phone' => [
                'required',
                'string',
                'min:12',
                'max:20',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
            ],

            'comment' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'bouquet_slug' => [
                'required',
                'string',
            ],

            'size_id' => [
                'required',
                'string',
            ],

        ];
    }

    public function messages(): array
    {
        return [

            'name.required' =>
                "Вкажіть, будь ласка, ваше ім'я",

            'name.min' =>
                "Ім'я повинно містити щонайменше 2 символи",

            'phone.required' =>
                'Вкажіть номер телефону',

            'email.required' =>
                'Вкажіть Email',

            'email.email' =>
                'Введіть коректний Email',

            'bouquet_slug.required' =>
                'Не вдалося визначити букет',

            'size_id.required' =>
                'Не вдалося визначити розмір букета',

        ];
    }
}