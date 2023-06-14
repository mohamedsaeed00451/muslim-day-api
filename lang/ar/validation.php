<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'يجب قبول الحقل :attribute.',
    'active_url' => 'الحقل :attribute ليس عنوان URL صالحًا.',
    'after' => 'يجب أن يكون الحقل :attribute تاريخًا بعد :date.',
    'after_or_equal' => 'يجب أن يكون الحقل :attribute تاريخًا بعد أو يساوي :date.',
    'alpha' => 'يجب أن يحتوي الحقل :attribute على أحرف فقط.',
    'alpha_dash' => 'يجب أن يحتوي الحقل :attribute على أحرف وأرقام وشرطات فقط.',
    'alpha_num' => 'يجب أن يحتوي الحقل :attribute على أحرف وأرقام فقط.',
    'array' => 'يجب أن يكون الحقل :attribute مصفوفة.',
    'before' => 'يجب أن يكون الحقل :attribute تاريخًا قبل :date.',
    'before_or_equal' => 'يجب أن يكون الحقل :attribute تاريخًا قبل أو يساوي :date.',
    'between' => [
        'numeric' => 'يجب أن يكون الحقل :attribute بين :min و :max.',
        'file' => 'يجب أن يكون حجم الحقل :attribute بين :min و :max كيلوبايت.',
        'string' => 'يجب أن يكون طول الحقل :attribute بين :min و :max حرفًا.',
        'array' => 'يجب أن يحتوي الحقل :attribute على بين :min و :max عنصرًا.',
    ],
    'boolean' => 'يجب أن يكون الحقل :attribute صحيحًا أو خطأ.',
    'confirmed' => 'حقل التأكيد غير متطابق مع الحقل :attribute.',
    'date' => 'الحقل :attribute ليس تاريخًا صالحًا.',
    'date_equals' => 'يجب أن يكون الحقل :attribute تاريخًا مساويًا لـ :date.',
    'date_format' => 'الحقل :attribute لا يتوافق مع الشكل :format.',
    'different' => 'يجب أن يكون الحقل :attribute مختلفًا عن الحقل :other.',
    'digits' => 'يجب أن يتكون الحقل :attribute من :digitsرقمًا.',
    'digits_between' => 'يجب أن يتكون الحقل :attribute من بين :min و :max أرقام.',
    'dimensions' => 'الحقل :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct' => 'الحقل :attribute يحتوي على قيمة مكررة.',
    'email' => 'يجب أن يكون الحقل :attribute عنوان بريد إلكتروني صالحًا.',
    'ends_with' => 'يجب أن ينتهي الحقل :attribute بإحدى القيم التالية: :values.',
    'exists' => 'الحقل :attribute المحدد غير صالح.',
    'file' => 'الحقل :attribute يجب أن يكون ملفًا.',
    'filled' => 'الحقل :attribute يجب أن يحتوي على قيمة.',
    'gt' => [
        'numeric' => 'يجب أن يكون الحقل :attribute أكبر من :value.',
        'file' => 'يجب أن يكون حجم الحقل :attribute أكبر من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول الحقل :attribute أكبر من :value حرفًا.',
        'array' => 'يجب أن يحتوي الحقل :attribute على أكثر من :value عنصر.',
    ],
    'gte' => [
        'numeric' => 'يجب أن يكون الحقل :attribute أكبر من أو يساوي :value.',
        'file' => 'يجب أن يكون حجم الحقل :attribute أكبر من أو يساوي :value كيلوبايت.',
        'string' => 'يجب أن يكون طول الحقل :attribute أكبر من أو يساوي :value حرفًا.',
        'array' => 'يجب أن يحتوي الحقل :attribute على :value عنصر أو أكثر.',
    ],
    'image' => 'يجب أن يكون الحقل :attribute صورة.',
    'in' => 'الحقل :attribute المحدد غير صالح.',
    'in_array' => 'الحقل :attribute غير موجود في :other.',
    'integer' => 'يجب أن يكون الحقل :attribute عددًا صحيحًا.',
    'ip' => 'يجب أن يكون الحقل :attribute عنوان IP صالحًا.',
    'ipv4' => 'يجب أن يكون الحقل :attribute عنوان IPv4 صالحًا.',
    'ipv6' => 'يجب أن يكون الحقل :attribute عنوان IPv6 صالحًا.',
    'json' => 'يجب أن يكون الحقل :attribute سلسلة JSON صالحة.',
    'lt' => [
        'numeric' => 'يجب أن يكون الحقل :attribute أقل من :value.',
        'file' => 'يجب أن يكون حجم الحقل :attribute أقل من :value كيلوبايت.',
        'string' => 'يجب أن يكون طول الحقل :attribute أقل من :value حرفًا.',
        'array' => 'يجب أن يحتوي الحقل :attribute على أقل من :value عنصر.',
    ],
    'lte' => [
        'numeric' => 'يجب أن يكون الحقل :attribute أقل من أو يساوي :value.',
        'file' => 'يجب أن يكون حجم الحقل :attribute أقل من أو يساوي :value كيلوبايت.',
        'string' => 'يجب أن يكون طول الحقل :attribute أقل من أو يساوي :value حرفًا.',
        'array' => 'يجب أن يحتوي الحقل :attribute على :value عنصرًا أو أقل.',
    ],
    'max' => [
        'numeric' => 'يجب ألا يتجاوز الحقل :attribute القيمة :max.',
        'file' => 'يجب ألا يتجاوز حجم الحقل :attribute :max كيلوبايت.',
        'string' => 'يجب ألا يتجاوز طول الحقل :attribute :max حرفًا.',
        'array' => 'يجب ألا يحتوي الحقل :attribute على أكثر من :max عنصر.',
    ],
    'mimes' => 'يجب أن يكون الحقل :attribute ملفًا من نوع: :values.',
    'mimetypes' => 'يجب أن يكون الحقل :attribute ملفًا من نوع: :values.',
    'min' => [
        'numeric' => 'يجب أن يكون الحقل :attribute على الأقل :min.',
        'file' => 'يجب أن يكون حجم الحقل :attribute على الأقل :min كيلوبايت.',
        'string' => 'يجب أن يكون طول الحقل :attribute على الأقل :min حرفًا.',
        'array' => 'يجب أن يحتوي الحقل :attribute على الأقل :min عنصرًا.',
    ],
    'not_in' => 'الحقل :attribute المحدد غير صالح.',
    'not_regex' => 'صيغة الحقل :attribute غير صالحة.',
    'numeric' => 'يجب أن يكون الحقل :attribute رقمًا.',
    'password' => 'كلمة المرور غير صحيحة.',
    'present' => 'يجب تقديم الحقل :attribute.',
    'regex' => 'صيغة الحقل :attribute غير صالحة.',
    'required' => 'الحقل :attribute مطلوب.',
    'required_if' => 'الحقل :attribute مطلوب عندما يكون :other يساوي :value.',
    'required_unless' => 'الحقل :attribute مطلوب ما لم :other يكون ضمن :values.',
    'required_with' => 'الحقل :attribute مطلوب عندما يتواجد :values.',
    'required_with_all' => 'الحقل :attribute مطلوب عندما يتواجد :values.',
    'required_without' => 'الحقل :attribute مطلوب عندما لا يتواجد :values.',
    'required_without_all' => 'الحقل :attribute مطلوب عندما لا يتواجد أي من :values.',
    'same' => 'يجب أن يتطابق الحقل :attribute مع :other.',
    'size' => [
        'numeric' => 'يجب أن يكون الحقل :attribute بحجم :size.',
        'file' => 'يجب أن يكون حجم الحقل :attribute :size كيلوبايت.',
        'string' => 'يجب أن يكون طول الحقل :attribute :size حرفًا.',
        'array' => 'يجب أن يحتوي الحقل :attribute على :size عنصرًا.',
    ],
    'starts_with' => 'يجب أن يبدأ الحقل :attribute بإحدى القيم التالية: :values.',
    'string' => 'يجب أن يكون الحقل :attribute سلسلة نصية.',
    'timezone' => 'يجب أن يكون الحقل :attribute منطقة صالحة.',
    'unique' => 'قيمة الحقل :attribute مُستخدمة من قبل.',
    'uploaded' => 'فشل تحميل الحقل :attribute.',
    'url' => 'صيغة الحقل :attribute غير صالحة.',
    'uuid' => 'يجب أن يكون الحقل :attribute UUID صالحًا.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'name' => 'الاسم',
        'email' => 'البريد الالكترونى',
        'password' => 'كلمة المرور',
        'terms_and_conditions' => 'الشروط والاحكام',
        'type' => 'النوع',
        'device_token' => 'معرف الجهاز',
        'otp' => 'الكود',
    ],

];
