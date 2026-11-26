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
                'regex:/\S/u',
            ],

            'phone' => [
                'required',
                'string',
                'min:12',
                'max:20',
                'regex:/^(?=(?:\D*\d){12,})[0-9+\s().-]+$/',
            ],

            'email' => [
                'required',
                'string',
                'email:rfc',
                'regex:/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/u',
                'max:255',
            ],

            'comment' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'items' => [
                'required',
                'array',
                'min:1',
                'max:30',
            ],

            'items.*.variant_id' => [
                'required',
                'integer',
                'exists:product_variants,id',
            ],

            'items.*.image_id' => [
                'required',
                'integer',
                'exists:product_images,id',
            ],

            'items.*.quantity' => [
                'required',
                'integer',
                'min:1',
                'max:99',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            // Ім'я
            'name.required' => 'Вкажіть ваше ім’я.',
            'name.min' => 'Ім’я повинно містити щонайменше 2 символи.',
            'name.max' => 'Ім’я занадто довге.',
            'name.regex' => 'Вкажіть коректне ім’я.',

            // Телефон
            'phone.required' => 'Вкажіть номер телефону.',
            'phone.min' => 'Перевірте правильність номера телефону.',
            'phone.max' => 'Номер телефону занадто довгий.',
            'phone.regex' => 'Номер телефону повинен містити щонайменше 12 цифр.',

            // Email
            'email.required' => 'Вкажіть електронну пошту.',
            'email.email' => 'Введіть коректну електронну адресу.',
            'email.regex' => 'Email повинен містити коректний домен, наприклад gmail.com.',
            'email.max' => 'Електронна адреса занадто довга.',

            // Коментар
            'comment.max' => 'Коментар не повинен перевищувати 1000 символів.',

            // Кошик
            'items.required' => 'Кошик порожній.',
            'items.min' => 'Додайте хоча б один товар до кошика.',
            'items.max' => 'У замовленні забагато позицій.',

            'items.*.variant_id.required' => 'Не вдалося визначити варіант товару.',
            'items.*.variant_id.exists' => 'Один із вибраних варіантів більше не існує.',

            'items.*.image_id.required' => 'Не вдалося визначити фотографію товару.',
            'items.*.image_id.exists' => 'Одна з вибраних фотографій більше не існує.',

            'items.*.quantity.required' => 'Вкажіть кількість товару.',
            'items.*.quantity.min' => 'Кількість товару повинна бути не менше 1.',
            'items.*.quantity.max' => 'Максимальна кількість однієї позиції — 99.',
        ];
    }
}
