<?php


if (!function_exists("chapterQuran")) {

    function chapterQuran()
    {
        $chapters = [
            [
                'surah_ar' => 'سورة الفاتحة',
                'surah_count' => '7',
                'from_page' => '1',
                'to_page' => '1'
            ],
            [
                'surah_ar' => 'سورة البقرة',
                'surah_count' => '286',
                'from_page' => '2',
                'to_page' => '44'
            ],
            [
                'surah_ar' => 'سورة ال عمران',
                'surah_count' => '200',
                'from_page' => '45',
                'to_page' => '68'
            ],
            [
                'surah_ar' => 'سورة النساء',
                'surah_count' => '176',
                'from_page' => '69',
                'to_page' => '95'
            ],
            [
                'surah_ar' => 'سورة المائده',
                'surah_count' => '120',
                'from_page' => '96',
                'to_page' => '114'
            ],
            [
                'surah_ar' => 'سورة الانعام',
                'surah_count' => '165',
                'from_page' => '115',
                'to_page' => '135'
            ],
            [
                'surah_ar' => 'سورة الإعراف',
                'surah_count' => '206',
                'from_page' => '136',
                'to_page' => '159'
            ],
            [
                'surah_ar' => 'سورة الإنفال',
                'surah_count' => '75',
                'from_page' => '160',
                'to_page' => '168'
            ],
            [
                'surah_ar' => 'سورة التوبة',
                'surah_count' => '129',
                'from_page' => '169',
                'to_page' => '186'
            ],
            [
                'surah_ar' => 'سورة يونس',
                'surah_count' => '109',
                'from_page' => '187',
                'to_page' => '199'
            ],
            [
                'surah_ar' => 'سورة هود',
                'surah_count' => '123',
                'from_page' => '200',
                'to_page' => '212'
            ],
            [
                'surah_ar' => 'سورة يوسف',
                'surah_count' => '111',
                'from_page' => '213',
                'to_page' => '224'
            ],
            [
                'surah_ar' => 'سورة الرعد',
                'surah_count' => '43',
                'from_page' => '225',
                'to_page' => '230'
            ],
            [
                'surah_ar' => 'سورة إبراهيم',
                'surah_count' => '52',
                'from_page' => '231',
                'to_page' => '236'
            ],
            [
                'surah_ar' => 'سورة الحجر',
                'surah_count' => '99',
                'from_page' => '237',
                'to_page' => '241'
            ],
            [
                'surah_ar' => 'سورة النحل',
                'surah_count' => '128',
                'from_page' => '242',
                'to_page' => '254'
            ],
            [
                'surah_ar' => 'سورة الإسراء',
                'surah_count' => '111',
                'from_page' => '255',
                'to_page' => '265'
            ],
            [
                'surah_ar' => 'سورة الكهف',
                'surah_count' => '110',
                'from_page' => '266',
                'to_page' => '276'
            ],
            [
                'surah_ar' => 'سورة مريم',
                'surah_count' => '98',
                'from_page' => '277',
                'to_page' => '283'
            ],
            [
                'surah_ar' => 'سورة طه',
                'surah_count' => '135',
                'from_page' => '284',
                'to_page' => '293'
            ],
            [
                'surah_ar' => 'سورة الأنبياء',
                'surah_count' => '112',
                'from_page' => '294',
                'to_page' => '302'
            ],
            [
                'surah_ar' => 'سورة الحج',
                'surah_count' => '78',
                'from_page' => '303',
                'to_page' => '310'
            ],
            [
                'surah_ar' => 'سورة المؤمنون',
                'surah_count' => '118',
                'from_page' => '311',
                'to_page' => '318'
            ],
            [
                'surah_ar' => 'سورة النور',
                'surah_count' => '64',
                'from_page' => '319',
                'to_page' => '328'
            ],
            [
                'surah_ar' => 'سورة الفرقان',
                'surah_count' => '77',
                'from_page' => '329',
                'to_page' => '334'
            ],
            [
                'surah_ar' => 'سورة الشعراء',
                'surah_count' => '227',
                'from_page' => '335',
                'to_page' => '344'
            ],
            [
                'surah_ar' => 'سورة النمل',
                'surah_count' => '93',
                'from_page' => '345',
                'to_page' => '353'
            ],
            [
                'surah_ar' => 'سورة القصص',
                'surah_count' => '88',
                'from_page' => '354',
                'to_page' => '363'
            ],
            [
                'surah_ar' => 'سورة العنكبوت',
                'surah_count' => '69',
                'from_page' => '364',
                'to_page' => '370'
            ],
            [
                'surah_ar' => 'سورة الروم',
                'surah_count' => '60',
                'from_page' => '371',
                'to_page' => '376'
            ],
            [
                'surah_ar' => 'سورة لقمان',
                'surah_count' => '34',
                'from_page' => '377',
                'to_page' => '380'
            ],
            [
                'surah_ar' => 'سورة السجده',
                'surah_count' => '30',
                'from_page' => '381',
                'to_page' => '383'
            ],
            [
                'surah_ar' => 'سورة الاحزاب',
                'surah_count' => '73',
                'from_page' => '384',
                'to_page' => '392'
            ],
            [
                'surah_ar' => 'سورة سبأ',
                'surah_count' => '54',
                'from_page' => '393',
                'to_page' => '398'
            ],
            [
                'surah_ar' => 'سورة فاطر',
                'surah_count' => '45',
                'from_page' => '399',
                'to_page' => '403'
            ],
            [
                'surah_ar' => 'سورة يس',
                'surah_count' => '83',
                'from_page' => '404',
                'to_page' => '409'
            ],
            [
                'surah_ar' => 'سورة الصافات',
                'surah_count' => '182',
                'from_page' => '410',
                'to_page' => '416'
            ],
            [
                'surah_ar' => 'سورة ص',
                'surah_count' => '88',
                'from_page' => '417',
                'to_page' => '422'
            ],
            [
                'surah_ar' => 'سورة الزمر',
                'surah_count' => '75',
                'from_page' => '423',
                'to_page' => '430'
            ],
            [
                'surah_ar' => 'سورة غافر',
                'surah_count' => '85',
                'from_page' => '431',
                'to_page' => '439'
            ],
            [
                'surah_ar' => 'سورة فصلت',
                'surah_count' => '54',
                'from_page' => '440',
                'to_page' => '444'
            ],
            [
                'surah_ar' => 'سورة الشورى',
                'surah_count' => '53',
                'from_page' => '445',
                'to_page' => '450'
            ],
            [
                'surah_ar' => 'سورة الزخرف',
                'surah_count' => '89',
                'from_page' => '451',
                'to_page' => '457'
            ],
            [
                'surah_ar' => 'سورة الدخان',
                'surah_count' => '59',
                'from_page' => '458',
                'to_page' => '460'
            ],
            [
                'surah_ar' => 'سورة الجاثيه',
                'surah_count' => '37',
                'from_page' => '461',
                'to_page' => '463'
            ],
            [
                'surah_ar' => 'سورة الاحقاف',
                'surah_count' => '35',
                'from_page' => '464',
                'to_page' => '468'
            ],
            [
                'surah_ar' => 'سورة محمد',
                'surah_count' => '38',
                'from_page' => '469',
                'to_page' => '472'
            ],
            [
                'surah_ar' => 'سورة الفتح',
                'surah_count' => '29',
                'from_page' => '473',
                'to_page' => '476'
            ],
            [
                'surah_ar' => 'سورة الحجرات',
                'surah_count' => '18',
                'from_page' => '477',
                'to_page' => '479'
            ],
            [
                'surah_ar' => 'سورة ق',
                'surah_count' => '45',
                'from_page' => '479',
                'to_page' => '482'
            ],
            [
                'surah_ar' => 'سورة الذاريات',
                'surah_count' => '60',
                'from_page' => '482',
                'to_page' => '485'
            ],
            [
                'surah_ar' => 'سورة الطور',
                'surah_count' => '49',
                'from_page' => '485',
                'to_page' => '487'
            ],
            [
                'surah_ar' => 'سورة النجم',
                'surah_count' => '62',
                'from_page' => '488',
                'to_page' => '490'
            ],
            [
                'surah_ar' => 'سورة القمر',
                'surah_count' => '55',
                'from_page' => '490',
                'to_page' => '493'
            ],
            [
                'surah_ar' => 'سورة الرحمن',
                'surah_count' => '78',
                'from_page' => '493',
                'to_page' => '496'
            ],
            [
                'surah_ar' => 'سورة الواقعة',
                'surah_count' => '96',
                'from_page' => '496',
                'to_page' => '499'
            ],
            [
                'surah_ar' => 'سورة الحديد',
                'surah_count' => '29',
                'from_page' => '500',
                'to_page' => '503'
            ],
            [
                'surah_ar' => 'سورة المجادلة',
                'surah_count' => '22',
                'from_page' => '504',
                'to_page' => '507'
            ],
            [
                'surah_ar' => 'سورة الحشر',
                'surah_count' => '24',
                'from_page' => '507',
                'to_page' => '510'
            ],
            [
                'surah_ar' => 'سورة الممتحنة',
                'surah_count' => '13',
                'from_page' => '511',
                'to_page' => '513'
            ],
            [
                'surah_ar' => 'سورة الصف',
                'surah_count' => '14',
                'from_page' => '513',
                'to_page' => '515'
            ],
            [
                'surah_ar' => 'سورة الجمعة',
                'surah_count' => '11',
                'from_page' => '515',
                'to_page' => '516'
            ],
            [
                'surah_ar' => 'سورة المنافقون',
                'surah_count' => '11',
                'from_page' => '516',
                'to_page' => '518'
            ],
            [
                'surah_ar' => 'سورة التغابن',
                'surah_count' => '18',
                'from_page' => '518',
                'to_page' => '519'
            ],
            [
                'surah_ar' => 'سورة الطلاق',
                'surah_count' => '12',
                'from_page' => '520',
                'to_page' => '522'
            ],
            [
                'surah_ar' => 'سورة التحريم',
                'surah_count' => '12',
                'from_page' => '522',
                'to_page' => '524'
            ],
            [
                'surah_ar' => 'سورة الملك',
                'surah_count' => '30',
                'from_page' => '524',
                'to_page' => '526'
            ],
            [
                'surah_ar' => 'سورة القلم',
                'surah_count' => '52',
                'from_page' => '526',
                'to_page' => '528'
            ],
            [
                'surah_ar' => 'سورة الحاقة',
                'surah_count' => '52',
                'from_page' => '529',
                'to_page' => '531'
            ],
            [
                'surah_ar' => 'سورة المعارج',
                'surah_count' => '44',
                'from_page' => '531',
                'to_page' => '533'
            ],
            [
                'surah_ar' => 'سورة نوح',
                'surah_count' => '28',
                'from_page' => '533',
                'to_page' => '534'
            ],
            [
                'surah_ar' => 'سورة الجن',
                'surah_count' => '28',
                'from_page' => '535',
                'to_page' => '536'
            ],
            [
                'surah_ar' => 'سورة المزمل',
                'surah_count' => '20',
                'from_page' => '537',
                'to_page' => '538'
            ],
            [
                'surah_ar' => 'سورة المدثر',
                'surah_count' => '56',
                'from_page' => '538',
                'to_page' => '540'
            ],
            [
                'surah_ar' => 'سورة القيامة',
                'surah_count' => '40',
                'from_page' => '540',
                'to_page' => '541'
            ],
            [
                'surah_ar' => 'سورة الإنسان',
                'surah_count' => '31',
                'from_page' => '542',
                'to_page' => '543'
            ],
            [
                'surah_ar' => 'سورة المرسلات',
                'surah_count' => '50',
                'from_page' => '544',
                'to_page' => '545'
            ],
            [
                'surah_ar' => 'سورة النبأ',
                'surah_count' => '40',
                'from_page' => '545',
                'to_page' => '547'
            ],
            [
                'surah_ar' => 'سورة النازعات',
                'surah_count' => '46',
                'from_page' => '547',
                'to_page' => '548'
            ],
            [
                'surah_ar' => 'سورة عبس',
                'surah_count' => '42',
                'from_page' => '549',
                'to_page' => '550'
            ],
            [
                'surah_ar' => 'سورة التكوير',
                'surah_count' => '29',
                'from_page' => '550',
                'to_page' => '551'
            ],
            [
                'surah_ar' => 'سورة الانفطار',
                'surah_count' => '19',
                'from_page' => '551',
                'to_page' => '551'
            ],
            [
                'surah_ar' => 'سورة المطففين',
                'surah_count' => '36',
                'from_page' => '552',
                'to_page' => '553'
            ],
            [
                'surah_ar' => 'سورة الانشقاق',
                'surah_count' => '24',
                'from_page' => '553',
                'to_page' => '554'
            ],
            [
                'surah_ar' => 'سورة البروج',
                'surah_count' => '22',
                'from_page' => '554',
                'to_page' => '555'
            ],
            [
                'surah_ar' => 'سورة الطارق',
                'surah_count' => '17',
                'from_page' => '555',
                'to_page' => '556'
            ],
            [
                'surah_ar' => 'سورة الأعلى',
                'surah_count' => '19',
                'from_page' => '556',
                'to_page' => '556'
            ],
            [
                'surah_ar' => 'سورة الغاشية',
                'surah_count' => '22',
                'from_page' => '557',
                'to_page' => '557'
            ],
            [
                'surah_ar' => 'سورة الفجر',
                'surah_count' => '30',
                'from_page' => '557',
                'to_page' => '558'
            ],
            [
                'surah_ar' => 'سورة البلد',
                'surah_count' => '18',
                'from_page' => '559',
                'to_page' => '559'
            ],
            [
                'surah_ar' => 'سورة الشمس',
                'surah_count' => '15',
                'from_page' => '559',
                'to_page' => '560'
            ],
            [
                'surah_ar' => 'سورة الليل',
                'surah_count' => '21',
                'from_page' => '560',
                'to_page' => '561'
            ],
            [
                'surah_ar' => 'سورة الضحى',
                'surah_count' => '11',
                'from_page' => '561',
                'to_page' => '561'
            ],
            [
                'surah_ar' => 'سورة الشرح',
                'surah_count' => '8',
                'from_page' => '561',
                'to_page' => '561'
            ],
            [
                'surah_ar' => 'سورة التين',
                'surah_count' => '8',
                'from_page' => '562',
                'to_page' => '562'
            ],
            [
                'surah_ar' => 'سورة العلق',
                'surah_count' => '19',
                'from_page' => '562',
                'to_page' => '563'
            ],
            [
                'surah_ar' => 'سورة القدر',
                'surah_count' => '5',
                'from_page' => '563',
                'to_page' => '563'
            ],
            [
                'surah_ar' => 'سورة البينة',
                'surah_count' => '8',
                'from_page' => '563',
                'to_page' => '564'
            ],
            [
                'surah_ar' => 'سورة الزلزلة',
                'surah_count' => '8',
                'from_page' => '564',
                'to_page' => '564'
            ],
            [
                'surah_ar' => 'سورة العاديات',
                'surah_count' => '11',
                'from_page' => '564',
                'to_page' => '565'
            ],
            [
                'surah_ar' => 'سورة القارعة',
                'surah_count' => '11',
                'from_page' => '565',
                'to_page' => '565'
            ],
            [
                'surah_ar' => 'سورة التكاثر',
                'surah_count' => '8',
                'from_page' => '565',
                'to_page' => '566'
            ],
            [
                'surah_ar' => 'سورة العصر',
                'surah_count' => '3',
                'from_page' => '566',
                'to_page' => '566'
            ],
            [
                'surah_ar' => 'سورة الهمزة',
                'surah_count' => '9',
                'from_page' => '566',
                'to_page' => '566'
            ],
            [
                'surah_ar' => 'سورة الفيل',
                'surah_count' => '5',
                'from_page' => '566',
                'to_page' => '567'
            ],
            [
                'surah_ar' => 'سورة قريش',
                'surah_count' => '4',
                'from_page' => '566',
                'to_page' => '567'
            ],
            [
                'surah_ar' => 'سورة الماعون',
                'surah_count' => '7',
                'from_page' => '566',
                'to_page' => '567'
            ],
            [
                'surah_ar' => 'سورة الكوثر',
                'surah_count' => '3',
                'from_page' => '568',
                'to_page' => '568'
            ],
            [
                'surah_ar' => 'سورة الكافرون',
                'surah_count' => '6',
                'from_page' => '568',
                'to_page' => '568'
            ],
            [
                'surah_ar' => 'سورة النصر',
                'surah_count' => '3',
                'from_page' => '568',
                'to_page' => '568'
            ],
            [
                'surah_ar' => 'سورة المسد',
                'surah_count' => '5',
                'from_page' => '568',
                'to_page' => '569'
            ],
            [
                'surah_ar' => 'سورة الإخلاص',
                'surah_count' => '4',
                'from_page' => '569',
                'to_page' => '569'
            ],
            [
                'surah_ar' => 'سورة الفلق',
                'surah_count' => '5',
                'from_page' => '569',
                'to_page' => '569'
            ],
            [
                'surah_ar' => 'سورة الناس',
                'surah_count' => '6',
                'from_page' => '569',
                'to_page' => '569'
            ],

        ];
        return $chapters;
    }
}