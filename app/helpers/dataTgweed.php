<?php


if (!function_exists("chapterTgweed")) {

    function chapterTgweed()
    {
        $chapters = [
            [
                'lesson_ar' => '(الفصل الأول)المقدمة ',
                'num_pages' => '3',
                'from_page' => '4',
                'to_page' => '4'
            ],
            [
                'lesson_ar' => '(الفصل الأول)فضل تلاوة القرآن الكريم ',
                'num_pages' => '5',
                'from_page' => '5',
                'to_page' => '5'
            ],
            [
                'lesson_ar' => '(الفصل الأول)آداب تلاوة القرآن الكريم',
                'num_pages' => '6',
                'from_page' => '6',
                'to_page' => '6'
            ],
            [
                'lesson_ar' => '(الفصل الأول)معنى التجويد وحكمه وغايته',
                'num_pages' => '7',
                'from_page' => '7',
                'to_page' => '7'
            ],
            [
                'lesson_ar' => '(الفصل الأول)مراتب القراءة شعبة القراءة',
                'num_pages' => '7',
                'from_page' => '7',
                'to_page' => '7'
            ],
            [
                'lesson_ar' => '(الفصل الأول)اللحن ',
                'num_pages' => '8',
                'from_page' => '8',
                'to_page' => '8'
            ],
            [
                'lesson_ar' => '(الفصل الأول)الاستعاذة ',
                'num_pages' => '9',
                'from_page' => '9',
                'to_page' => '9'
            ],
            [
                'lesson_ar' => '(الفصل الأول)البسملة ',
                'num_pages' => '10',
                'from_page' => '10',
                'to_page' => '10'
            ],
            [
                'lesson_ar' => '(الفصل الأول)أسماء القراء العشرة ورواتهم',
                'num_pages' => '11',
                'from_page' => '11',
                'to_page' => '11'
            ],
            [
                'lesson_ar' => '(الفصل الثاني)الحروف العربية',
                'num_pages' => '13',
                'from_page' => '12',
                'to_page' => '13'
            ],
            [
                'lesson_ar' => '(الفصل الثاني) مخارج الحروف ',
                'num_pages' => '14',
                'from_page' => '14',
                'to_page' => '15'
            ],
            [
                'lesson_ar' => '(الفصل الثاني)الصور التوضيحية لأعضاء النطق',
                'num_pages' => '16',
                'from_page' => '16',
                'to_page' => '16'
            ],
            [
                'lesson_ar' => '(الفصل الثاني) الجوف',
                'num_pages' => '17',
                'from_page' => '17',
                'to_page' => '17'
            ],
            [
                'lesson_ar' => '(الفصل الثاني) الحلق',
                'num_pages' => '18',
                'from_page' => '18',
                'to_page' => '18'
            ],
            [
                'lesson_ar' => '(الفصل الثاني)اللسان',
                'num_pages' => '19',
                'from_page' => '19',
                'to_page' => '21'
            ],
            [
                'lesson_ar' => '(الفصل الثاني)الشفتان',
                'num_pages' => '22',
                'from_page' => '22',
                'to_page' => '22'
            ],
            [
                'lesson_ar' => '(الفصل الثاني)الخيشوم',
                'num_pages' => '22',
                'from_page' => '22',
                'to_page' => '22'
            ],
            [
                'lesson_ar' => '(الفصل الثاني)ألقاب الحروف',
                'num_pages' => '23',
                'from_page' => '23',
                'to_page' => '23'
            ],
            [
                'lesson_ar' => '(الفصل الثالث)صفات الحروف',
                'num_pages' => '25',
                'from_page' => '23',
                'to_page' => '26'
            ],
            [
                'lesson_ar' => '(الفصل الثالث)الهمس والجهر',
                'num_pages' => '27',
                'from_page' => '27',
                'to_page' => '27'
            ],
            [
                'lesson_ar' => '(الفصل الثالث)الشدة والرخاوة والبينية ',
                'num_pages' => '28',
                'from_page' => '28',
                'to_page' => '28'
            ],
            [
                'lesson_ar' => '(الفصل الثالث)الاستعلاء والاستفال',
                'num_pages' => '29',
                'from_page' => '29',
                'to_page' => '29'
            ],
            [
                'lesson_ar' => '(الفصل الثالث)الاطباق والانفتاح',
                'num_pages' => '30',
                'from_page' => '30',
                'to_page' => '30'
            ],
            [
                'lesson_ar' => '(الفصل الثالث)الإذلاق والإصمات',
                'num_pages' => '30',
                'from_page' => '30',
                'to_page' => '30'
            ],
            [
                'lesson_ar' => '(الفصل الثالث)الصفير والقلقله واللين',
                'num_pages' => '31',
                'from_page' => '31',
                'to_page' => '31'
            ],
            [
                'lesson_ar' => '(الفصل الثالث)الانحراف والتكرير والتفشيوالاستطاله',
                'num_pages' => '32',
                'from_page' => '32',
                'to_page' => '32'
            ],
            [
                'lesson_ar' => '(الفصل الرابع)التفخيم والترقيق ',
                'num_pages' => '34',
                'from_page' => '33',
                'to_page' => '34'
            ],
            [
                'lesson_ar' => '(الفصل الرابع)الحروف المفخمة دائما',
                'num_pages' => '35',
                'from_page' => '35',
                'to_page' => '35'
            ],
            [
                'lesson_ar' => '(الفصل الرابع)الحروف المرققة دائما',
                'num_pages' => '35',
                'from_page' => '35',
                'to_page' => '35'
            ],
            [
                'lesson_ar' => '(الفصل الرابع)الحروف المفخمة تارة والمرققة تارة ',
                'num_pages' => '36',
                'from_page' => '36',
                'to_page' => '38'
            ],
            [
                'lesson_ar' => '(الفصل الرابع)النون الساكنة والتنوين',
                'num_pages' => '39',
                'from_page' => '39',
                'to_page' => '39'
            ],
            [
                'lesson_ar' => '(الفصل الرابع)الإظهار',
                'num_pages' => '40',
                'from_page' => '40',
                'to_page' => '40'
            ],
            [
                'lesson_ar' => '(الفصل الرابع)الإدغام',
                'num_pages' => '41',
                'from_page' => '41',
                'to_page' => '42'
            ],
            [
                'lesson_ar' => '(الفصل الرابع)الإقلاب',
                'num_pages' => '34',
                'from_page' => '34',
                'to_page' => '34'
            ],
            [
                'lesson_ar' => '(الفصل الرابع)الإخفاء',
                'num_pages' => '44',
                'from_page' => '44',
                'to_page' => '44'
            ],
            [
                'lesson_ar' => '(الفصل الخامس)الميم الساكنة',
                'num_pages' => '46',
                'from_page' => '45',
                'to_page' => '47'
            ],
            [
                'lesson_ar' => '(الفصل الخامس)النون والميم المشددتي',
                'num_pages' => '48',
                'from_page' => '48',
                'to_page' => '48'
            ],
            [
                'lesson_ar' => '(الفصل الخامس)علاقات الحروف',
                'num_pages' => '49',
                'from_page' => '49',
                'to_page' => '51'
            ],
            [
                'lesson_ar' => '(الفصل الخامس)أحكام اللام الساكنة',
                'num_pages' => '52',
                'from_page' => '52',
                'to_page' => '53'
            ],
            [
                'lesson_ar' => '(الفصل السادس)المد',
                'num_pages' => '55',
                'from_page' => '54',
                'to_page' => '55'
            ],
            [
                'lesson_ar' => '(الفصل السادس)المد الاصلي الطبيعي',
                'num_pages' => '56',
                'from_page' => '56',
                'to_page' => '56'
            ],
            [
                'lesson_ar' => '(الفصل السادس)بسبب الهمز',
                'num_pages' => '57',
                'from_page' => '57',
                'to_page' => '57'
            ],
            [
                'lesson_ar' => '(الفصل السادس)المد اللازم الكلمي ',
                'num_pages' => '58',
                'from_page' => '58',
                'to_page' => '59'
            ],
            [
                'lesson_ar' => '(الفصل السادس)المد العارض للسكون',
                'num_pages' => '59',
                'from_page' => '59',
                'to_page' => '59'
            ],
            [
                'lesson_ar' => '(الفصل السادس)المد اللين',
                'num_pages' => '59',
                'from_page' => '59',
                'to_page' => '59'
            ],
            [
                'lesson_ar' => '(الفصل السادس)أحكام المد في فواتح السور',
                'num_pages' => '59',
                'from_page' => '59',
                'to_page' => '59'
            ],
            [
                'lesson_ar' => '(الفصل السادس)الألفات السبعة',
                'num_pages' => '60',
                'from_page' => '60',
                'to_page' => '60'
            ],
            [
                'lesson_ar' => '(الفصل السادس)مسألة أقوى السببين ',
                'num_pages' => '61',
                'from_page' => '61',
                'to_page' => '61'
            ],
            [
                'lesson_ar' => '(الفصل السادس)مخطط يوضح  أقسام المدو ',
                'num_pages' => '62',
                'from_page' => '62',
                'to_page' => '62'
            ],
            [
                'lesson_ar' => '(الفصل السابع)همزتا القطع والوصل',
                'num_pages' => '64',
                'from_page' => '63',
                'to_page' => '65'
            ],
            [
                'lesson_ar' => '(الفصل السابع)التقاء الساكني',
                'num_pages' => '66',
                'from_page' => '66',
                'to_page' => '66'
            ],
            [
                'lesson_ar' => '(الفصل السابع)الوقف',
                'num_pages' => '67',
                'from_page' => '67',
                'to_page' => '69'
            ],
            [
                'lesson_ar' => '(الفصل السابع)السكت',
                'num_pages' => '70',
                'from_page' => '70',
                'to_page' => '70'
            ],
            [
                'lesson_ar' => '(الفصل السابع)كيفية الوقوف الصحيح',
                'num_pages' => '71',
                'from_page' => '71',
                'to_page' => '74'
            ],
            [
                'lesson_ar' => '(الفصل السابع)النبر في القران الكريم',
                'num_pages' => '75',
                'from_page' => '75',
                'to_page' => '75'
            ],
            [
                'lesson_ar' => '(الفصل السابع)علامات الوقف في المصحف',
                'num_pages' => '76',
                'from_page' => '76',
                'to_page' => '76'
            ],
            [
                'lesson_ar' => '(الفصل السابع)المصادر',
                'num_pages' => '77',
                'from_page' => '77',
                'to_page' => '79'
            ],
        ];

        return $chapters;
    }
}