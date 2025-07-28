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

    'accepted' => 'گزینه :attribute باید تایید شود',
    'accepted_if' => 'زمانی که گزینه :other برابر :value است :attribute باید تایید شود',
    'active_url' => 'گزینه :attribute یک آدرس سایت معتبر نیست',
    'after' => 'گزینه :attribute باید تاریخی بعد از :date باشد',
    'after_or_equal' => 'گزینه :attribute باید تاریخی مساوی یا بعد از :date باشد',
    'alpha' => 'گزینه :attribute باید تنها شامل حروف باشد',
    'alpha_dash' => 'گزینه :attribute باید تنها شامل حروف، اعداد، خط تیره و زیر خط باشد',
    'alpha_num' => 'گزینه :attribute باید تنها شامل حروف و اعداد باشد',
    'array' => 'گزینه :attribute باید آرایه باشد',
    'before' => 'گزینه :attribute باید تاریخی قبل از :date باشد',
    'before_or_equal' => 'گزینه :attribute باید تاریخی مساوی یا قبل از :date باشد',
    'between' => [
        'numeric' => 'گزینه :attribute باید بین :min و :max باشد',
        'file' => 'گزینه :attribute باید بین :min و :max کیلوبایت باشد',
        'string' => 'گزینه :attribute باید بین :min و :max کاراکتر باشد',
        'array' => 'گزینه :attribute باید بین :min و :max آیتم باشد',
    ],
    'boolean' => 'گزینه :attribute تنها می تواند صحیح یا غلط باشد',
    'confirmed' => 'تایید مجدد گزینه :attribute صحیح نمی باشد',
    'current_password' => 'رمزعبور صحیح نمی باشد',
    'date' => 'گزینه :attribute یک تاریخ صحیح نمی باشد',
    'date_equals' => 'گزینه :attribute باید تاریخی مساوی با :date باشد',
    'date_format' => 'گزینه :attribute با فرمت :format همخوانی ندارد',
    'different' => 'گزینه :attribute و :other باید متفاوت باشند',
    'digits' => 'گزینه :attribute باید :digits عدد باشد',
    'digits_between' => 'گزینه :attribute باید بین :min و :max عدد باشد',
    'dimensions' => 'ابعاد تصویر گزینه :attribute مجاز نمی باشد',
    'distinct' => 'گزینه :attribute دارای افزونگی داده می باشد',
    'email' => 'گزینه :attribute باید یک آدرس ایمیل صحیح باشد',
    'ends_with' => 'گزینه :attribute باید با یکی از این مقادیر پایان یابد، :values',
    'exists' => 'گزینه انتخاب شده :attribute صحیح نمی باشد',
    'file' => 'گزینه :attribute باید یک فایل باشد',
    'filled' => 'گزینه :attribute نمی تواند خالی باشد',
    'gt' => [
        'numeric' => 'گزینه :attribute باید بزرگتر از :value باشد',
        'file' => 'گزینه :attribute باید بزرگتر از :value کیلوبایت باشد',
        'string' => 'گزینه :attribute باید بزرگتر از :value کاراکتر باشد',
        'array' => 'گزینه :attribute باید بیشتر از :value آیتم باشد',
    ],
    'gte' => [
        'numeric' => 'گزینه :attribute باید بزرگتر یا مساوی :value باشد',
        'file' => 'گزینه :attribute باید بزرگتر یا مساوی :value کیلوبایت باشد',
        'string' => 'گزینه :attribute باید بزرگتر یا مساوی :value کاراکتر باشد',
        'array' => 'گزینه :attribute باید :value آیتم یا بیشتر داشته باشد',
    ],
    'image' => 'گزینه :attribute باید از نوع تصویر باشد',
    'in' => 'گزینه انتخابی :attribute صحیح نمی باشد',
    'in_array' => 'گزینه :attribute در :other وجود ندارد',
    'integer' => 'گزینه :attribute باید از نوع عددی باشد',
    'ip' => 'گزینه :attribute باید آی پی آدرس باشد',
    'ipv4' => 'گزینه :attribute باید آی پی آدرس ورژن 4 باشد',
    'ipv6' => 'گزینه :attribute باید آی پی آدرس ورژن 6 باشد',
    'json' => 'گزینه :attribute باید از نوع رشته جیسون باشد',
    'lt' => [
        'numeric' => 'گزینه :attribute باید کمتر از :value باشد',
        'file' => 'گزینه :attribute باید کمتر از :value کیلوبایت باشد',
        'string' => 'گزینه :attribute باید کمتر از :value کاراکتر باشد',
        'array' => 'گزینه :attribute باید کمتر از :value آیتم داشته باشد',
    ],
    'lte' => [
        'numeric' => 'گزینه :attribute باید مساوی یا کمتر از :value باشد',
        'file' => 'گزینه :attribute باید مساوی یا کمتر از :value کیلوبایت باشد',
        'string' => 'گزینه :attribute باید مساوی یا کمتر از :value کاراکتر باشد',
        'array' => 'گزینه :attribute نباید کمتر از :value آیتم داشته باشد',
    ],
    'max' => [
        'numeric' => 'گزینه :attribute نباید بزرگتر از :max باشد',
        'file' => 'گزینه :attribute نباید بزرگتر از :max کیلوبایت باشد',
        'string' => 'گزینه :attribute نباید بزرگتر از :max کاراکتر باشد',
        'array' => 'گزینه :attribute نباید بیشتر از :max آیتم داشته باشد',
    ],
    'mimes' => 'گزینه :attribute باید دارای یکی از این فرمت ها باشد: :values',
    'mimetypes' => 'گزینه :attribute باید دارای یکی از این فرمت ها باشد: :values',
    'min' => [
        'numeric' => 'گزینه :attribute باید حداقل :min باشد',
        'file' => 'گزینه :attribute باید حداقل :min کیلوبایت باشد',
        'string' => 'گزینه :attribute باید حداقل :min کاراکتر باشد',
        'array' => 'گزینه :attribute باید حداقل :min آیتم داشته باشد',
    ],
    'multiple_of' => 'گزینه :attribute باید حاصل ضرب :value باشد',
    'not_in' => 'گزینه انتخابی :attribute صحیح نمی باشد',
    'not_regex' => 'فرمت گزینه :attribute صحیح نمی باشد',
    'numeric' => 'گزینه :attribute باید از نوع عددی باشد',
    'password' => 'رمزعبور صحیح نمی باشد',
    'present' => 'گزینه :attribute باید از نوع درصد باشد',
    'regex' => 'فرمت گزینه :attribute صحیح نمی باشد',
    'required' => 'تکمیل گزینه :attribute الزامی است',
    'required_if' => 'تکمیل گزینه :attribute زمانی که :other دارای مقدار :value است الزامی می باشد',
    'required_unless' => 'تکمیل گزینه :attribute الزامی می باشد مگر :other دارای مقدار :values باشد',
    'required_with' => 'تکمیل گزینه :attribute زمانی که مقدار :values درصد است الزامی است',
    'required_with_all' => 'تکمیل گزینه :attribute زمانی که مقادیر :values درصد است الزامی می باشد',
    'required_without' => 'تکمیل گزینه :attribute زمانی که مقدار :values درصد نیست الزامی است',
    'required_without_all' => 'تکمیل گزینه :attribute زمانی که هیچ کدام از مقادیر :values درصد نیست الزامی است',
    'same' => 'گزینه های :attribute و :other باید یکی باشند',
    'size' => [
        'numeric' => 'گزینه :attribute باید :size باشد',
        'file' => 'گزینه :attribute باید :size کیلوبایت باشد',
        'string' => 'گزینه :attribute باید :size  کاراکتر باشد',
        'array' => 'گزینه :attribute باید شامل :size آیتم باشد',
    ],
    'starts_with' => 'گزینه :attribute باید با یکی از این مقادیر شروع شود، :values',
    'string' => 'گزینه :attribute باید تنها شامل حروف باشد',
    'timezone' => 'گزینه :attribute باید از نوع منطقه زمانی صحیح باشد',
    'unique' => 'این :attribute قبلاً ثبت شده است',
    'uploaded' => 'آپلود گزینه :attribute شکست خورد',
    'url' => 'فرمت :attribute اشتباه است',
    'uuid' => 'گزینه :attribute باید یک UUID صحیح باشد',
    "There was an error on row :row. :message" => "سطر :row : :message",

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
        'name' => 'نام',
        "ma_date" => 'تاریخ تولید',
        "ex_date" => 'تاریخ انقضاء',
        'family' => 'نام خانوادگی',
        'serial' => 'سریال',
        'product_id' => 'شناسه محصول',
        'relation_category_id' => 'شناسه دسته بندی ارتباط',
        'from_serial' => 'از سریال',
        'to_serial' => 'تا سریال',
        'call_time' => 'تاریخ تماس',
        'call_result' => 'نتیجه تماس',
        'next_call_time' => 'تاریخ پیگیری بعدی',
        'active_date' => 'تاریخ فعالسازی',
        'birth_date' => 'سال تولد',
        'username' => 'نام کاربری',
        'email' => 'ایمیل',
        'services.*.id' => 'شناسه خدمت سطر :position',
        'services.*.amount' => 'مبلغ خدمت سطر :position',
        'first_name' => 'نام',
        'last_name' => 'نام خانوادگی',
        'password' => 'رمز عبور',
        'repeat_password' => 'تکرار رمز عبور',
        'city' => 'شهر',
        'state' => 'استان',
        'country' => 'کشور',
        'address' => 'آدرس',
        'phone' => 'تلفن',
        'mobile' => 'تلفن همراه',
        'age' => 'سن',
        'sex' => 'جنسیت',
        'gender' => 'جنسیت',
        'day' => 'روز',
        'month' => 'ماه',
        'year' => 'سال',
        'hour' => 'ساعت',
        'minute' => 'دقیقه',
        'second' => 'ثانیه',
        'title' => 'عنوان',
        'text' => 'متن',
        'content' => 'محتوا',
        'description' => 'توضیحات',
        'date' => 'تاریخ',
        'time' => 'زمان',
        'available' => 'موجود',
        'type' => 'نوع',
        'img' => 'تصویر',
        'image' => 'تصویر',
        'size' => 'اندازه',
        'color' => 'رنگ',
        'captcha' => 'کد امنیتی',
        'price' => 'قیمت',
        'pic' => 'تصویر',
        'link' => 'لینک',
        'en_name'=> 'نام انگلیسی',
        "product_category_id" => 'شناسه دسته بندی محصول',
        'contact_id' => 'مخاطب',
        'car_number' => 'پلاک خودرو',
        'indicator' => 'شماره فاکتور',
        'project_id' => 'پروژه',
        'subject_id' => 'موضوع',
        'tax_value_added' => 'محاسبه مالیات بر ارزش افزوده خرید',
        'sale_conditions' => 'خرید نقدی / اعتباری',
        'obligations' => 'تعهدات',
        'obligations.*.project_id' => 'پروژه تعهدات',
        'obligations.*.subject_id' => 'موضوع تعهدات',
        'obligations.*.date' => 'تاریخ تعهدات',
        'obligations.*.forecast_amount' => 'مبلغ تعهدات',
        'obligations.*.description' => 'توضیحات تعهدات',
        'invoice_commodities.*.commodity_id' => 'کالای جزئیات فاکتور',
        'invoice_commodities.*.quantity' => 'تعداد کالای جزئیات فاکتور',
        'invoice_commodities.*.unit' => 'واحد اندازه گیری جزئیات فاکتور',
        'invoice_commodities.*.price' => 'قیمت جزئیات فاکتور',
        'invoice_commodities.*.discount' => 'تخفیف جزئیات فاکتور',
        'economic_code' => 'کد اقتصادی',
        'national_code' => 'کد ملی',
        'registration_number' => 'شماره ثبت',
        'province' => 'استان',
        'postal_code' => 'کد پستی',
        'obligations.*.contact_id' => 'مخاطب تعهدات',
        'invoice_id' => 'فاکتور',
        'forecast_amount' => 'مبلغ پیش بینی',
        'coding' => 'کد کالا',
        'unit' => 'واحد اندازه گیری',
        'c_accounts' => 'حوزه های اصلی فعالیت',
        'c_begin_date' => 'تاریح شروع فعالیت',
        'c_city' => 'شهر',
        'c_description' => 'توضیحات',
        'c_name' => 'نام',
        'c_person' => 'پرسنل',
        'c_problems' => 'مشکلات و موانع',
        'c_register_date' => 'تاریخ ثبت',
        'c_state' => 'استان',
        'c_submit_type' => 'نوع ثبت',
        'c_website' => 'وب سایت',
        'c_economic_code' => 'کد اقتصادی',
        'c_national_code' => 'کد ملی',
        'c_registration_number' => 'شماره ثبت',
        'c_address' => 'ادرس',
        'c_mobile' => 'موبایل',
        'c_postal_code' => 'کدپستی',
        'c_phone' => 'تلفن',
        'drug' => 'دارو',
        'sickness' => 'بیماری',
        'position_id' => 'سمت'
    ],
];
