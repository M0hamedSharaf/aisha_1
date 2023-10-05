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

    'accepted' => 'ال :attribute يجب قبوله.',
    'accepted_if' => 'ال :attribute يجب قبولها عندما :other يكون :value.',
    'active_url' => 'ال :attribute ليس صحيحا URL.',
    'after' => 'ال :attribute يجب أن يكون تاريخًا بعد :date.',
    'after_or_equal' => 'The :attribute يجب أن يكون تاريخًا بعد أو يساوي :date.',
    'alpha' => 'ال :attribute يجب أن يحتوي على أحرف فقط.',
    'alpha_dash' => 'ال :attribute يجب أن تحتوي فقط على أحرف وأرقام وشرطات وشرطات سفلية.',
    'alpha_num' => 'ال :attribute يجب أن يحتوي على أحرف وأرقام فقط.',
    'array' => 'ال :attribute يجب أن يكون مصفوفة.',
    'before' => 'The :attribute يجب أن يكون تاريخ قبل :date.',
    'before_or_equal' => 'The :attribute يجب أن يكون تاريخًا يسبق أو يساوي :date.',
    'between' => [
        'array' => 'The :attribute يجب أن يكون بين :min و :max أغراض.',
        'file' => 'The :attribute يجب أن يكون بين :min و :max كيلوبيت.',
        'numeric' => 'The :attribute يجب أن يكون بين :min و :max.',
        'string' => 'The :attribute يجب أن يكون بين :min و :max شخصيات.',
    ],
    'boolean' => 'ال :attribute fيجب أن يكون الحقل صحيحًا أو خطأ.',
    'confirmed' => 'ال :attribute التأكيد غير متطابق.',
    'current_password' => 'كلمة المرور غير صحيحة.',
    'date' => 'ال :attribute هذا ليس تاريخ صحيح.',
    'date_equals' => 'ال :attribute يجب أن يكون تاريخًا مساويًا لـ :date.',
    'date_format' => 'ال :attribute لا يتطابق مع الشكل :format.',
    'declined' => 'ال :attribute يجب رفضه.',
    'declined_if' => 'ال :attribute يجب رفضه عندما :other يكون :value.',
    'different' => 'ال :attribute و :other يجب أن تكون مختلف.',
    'digits' => 'ال :attribute يجب ان كون :digits أرقام.',
    'digits_between' => 'ال :attribute يجب أن يكون بين :min و :max أرقام.',
    'dimensions' => 'ال :attribute أبعاد الصورة غير صالحة.',
    'distinct' => 'ال :attribute الحقل له قيمة مكررة.',
    'doesnt_end_with' => 'ال :attribute قد لا ينتهي بواحد مما يلي: :values.',
    'doesnt_start_with' => 'ال :attribute قد لا تبدأ بواحد مما يلي : :values.',
    'email' => 'ال :attribute يجب أن يكون عنوان بريد إلكتروني صالح.',
    'ends_with' => 'ال :attributeيجب أن ينتهي بواحد مما يلي : :values.',
    'enum' => 'ال selected :attribute غير صالح.',
    'exists' => 'ال selected :attribute غير صالح.',
    'file' => 'ال :attribute يجب أن يكون ملفًا.',
    'filled' => 'ال :attribute يجب أن يكون للحقل قيمة.',
    'gt' => [
        'array' => 'ال :attribute يجب أن يحتوي على أكثر من :value أغراض.',
        'file' => 'ال :attribute يجب أن يكون أكبر من:value كيلوبايت.',
        'numeric' => 'ال :attribute يجب أن يكون أكبر من:value.',
        'string' => 'ال :attribute يجب أن يكون أكبر من:value characters.',
    ],
    'gte' => [
        'array' => 'ال :attribute يجب ان يملك :value من العناصر أو أكثر.',
        'file' => 'ال :attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
        'numeric' => 'ال :attribute يجب أن يكون أكبر من أو يساوي :value.',
        'string' => 'ال :attribute يجب أن يكون أكبر من أو يساوي :value شخصيات.',
    ],
    'image' => 'ال :attribute يجب ان تكون صورة.',
    'in' => 'المحدد :attribute غير صالح.',
    'in_array' => 'ال :attribute الحقل غير موجود في :other.',
    'integer' => 'ال :attribute يجب أن يكون صحيحا.',
    'ip' => 'ال :attribute يجب أن يكون صالحًا IP عنوان.',
    'ipv4' => 'ال :attribute يجب أن يكون صالحًا IPv4 عنوان.',
    'ipv6' => 'ال :attribute يجب أن يكون صالحًا IPv6 عنوان.',
    'json' => 'ال :attribute يجب أن يكون صالحًا JSON string.',
    'lt' => [
        'array' => 'ال :attribute يجب أن يكون أقل من :value اغراض.',
        'file' => 'ال :attribute يجب أن يكون أقل من :value كيلوبايت.',
        'numeric' => 'ال :attribute يجب أن يكون أقل من :value.',
        'string' => 'ال :attribute يجب أن يكون أقل من :value شخصيات.',
    ],
    'lte' => [
        'array' => 'ال :attribute يجب ألا يحتوي على أكثر من :value اغراض.',
        'file' => 'ال :attribute يجب أن يكون أصغر من أو يساوي :value كيلوبايت.',
        'numeric' => 'ال :attribute يجب أن يكون أصغر من أو يساوي :value.',
        'string' => 'ال :attribute يجب أن يكون أصغر من أو يساوي :value شخصيات.',
    ],
    'mac_address' => 'ال :attribute يجب أن يكون صالحًا MAC عنوان.',
    'max' => [
        'array' => 'ال :attribute يجب ألا يحتوي على أكثر من :max اغراض.',
        'file' => 'ال :attribute يجب ألا يكون أكبر من :max كيلوبايت.',
        'numeric' => 'ال :attribute يجب ألا يكون أكبر من :max.',
        'string' => 'ال :attribute يجب ألا يكون أكبر من :max شخصيات.',
    ],
    'mimes' => 'ال :attribute يجب أن يكون ملفًا من النوع: :values.',
    'mimetypes' => 'ال :attribute يجب أن يكون ملفًا من النوع: :values.',
    'min' => [
        'array' => 'ال :attribute يجب أن يكون على الأقل:min اغراض.',
        'file' => 'ال :attribute لا بد أن يكون على الأقل :min كيلوبايت.',
        'numeric' => 'ال :attribute لا بد أن يكون على الأقل :min.',
        'string' => 'ال :attribute لا بد أن يكون على الأقل :min شخصيات.',
    ],
    'multiple_of' => 'ال :attribute يجب أن يكون من مضاعفات:value.',
    'not_in' => 'ال selected :attribute غير صالح.',
    'not_regex' => 'ال :attribute التنسيق غير صالح.',
    'numeric' => 'ال :attribute يجب أن يكون رقما.',
    'password' => [
        'letters' => 'ال :attribute يجب أن يحتوي على حرف واحد على الأقل.',
        'mixed' => 'ال :attribute يجب أن تحتوي على حرف كبير واحد على الأقل.',
        'numbers' => 'ال :attribute يجب أن يحتوي على واحد على الأقل رقم.',
        'symbols' => 'ال :attribute يجب أن يحتوي على واحد على الأقل رمز.',
        'uncompromised' => 'ال given :attribute ظهر في تسرب البيانات. الرجاء اختيار ملف :attribute.',
    ],
    'present' => 'ال :attribute يجب أن يكون الحقل موجودًا.',
    'prohibited' => 'ال :attribute المجال محظور.',
    'prohibited_if' => 'ال :attribute المجال محظور عندما :other يكون :value.',
    'prohibited_unless' => 'ال :attribute الحقل محظور ما لم :other يكون فى :values.',
    'prohibits' => 'ال :attribute يحظر المجال :other من الوجود.',
    'regex' => 'ال :attribute التنسيق غير صالح.',
    'required' => 'ال :attribute الحقل مطلوب.',
    'required_array_keys' => 'ال :attribute يجب أن يحتوي الحقل على إدخالات لـ: :values.',
    'required_if' => 'ال :attribute الحقل مطلوب عندما :other يكون :value.',
    'required_unless' => 'ال :attribute الحقل مطلوب ما لم يكن :other يكون فى :values.',
    'required_with' => 'ال :attribute الحقل مطلوب عندما :values يكون present.',
    'required_with_all' => 'ال :attribute الحقل مطلوب عندما :values يكون present.',
    'required_without' => 'ال :attribute الحقل مطلوب عندما :values لا يكون present.',
    'required_without_all' => 'ال :attribute الحقل مطلوب عندمالا شيء من :values يكون present.',
    'same' => 'ال :attribute و :other يجب أن تتطابق.',
    'size' => [
        'array' => 'ال :attribute يجب أن تحتوي على :size اغراض.',
        'file' => 'ال :attribute يجب ان :size كيلوبايت.',
        'numeric' => 'ال :attribute يجب ان :size.',
        'string' => 'ال :attribute يجب ان :size شخصيات.',
    ],
    'starts_with' => 'ال :attribute يجب أن يبدأ بواحد مما يلي : :values.',
    'string' => 'ال :attribute يجب أن يكون سلسلة.',
    'timezone' => 'ال :attribute يجب أن تكون منطقة زمنية صالحة.',
    'unique' => 'ال :attribute لقد اتخذت بالفعل.',
    'uploaded' => 'ال :attribute فشل التحميل.',
    'url' => 'ال :attribute يجب أن يكون صالحًا URL.',
    'uuid' => 'ال :attribute يجب أن يكون صالحًا UUID.',

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

    'attributes' => [],

];
