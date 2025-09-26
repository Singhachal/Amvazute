<?php

if (!function_exists('available_languages')) {
    function available_languages()
    {
        return [
            'en' => ['name' => 'English', 'flag' => 'en.png'],
            'hi' => ['name' => 'हिंदी', 'flag' => 'in.png'],
            'fr' => ['name' => 'Français', 'flag' => 'fr.png'],
            'es' => ['name' => 'Español', 'flag' => 'es.png'],
            'ar' => ['name' => 'العربية', 'flag' => 'sa.png'],
            'de' => ['name' => 'Deutsch', 'flag' => 'de.png'],
            'zh' => ['name' => '中文', 'flag' => 'cn.png'],
            'ja' => ['name' => '日本語', 'flag' => 'jp.png'],
            'ru' => ['name' => 'Русский', 'flag' => 'ru.png'],
            'pt' => ['name' => 'Português', 'flag' => 'pt.png'],
            'bn' => ['name' => 'বাংলা', 'flag' => 'bd.png'],
            'pa' => ['name' => 'ਪੰਜਾਬੀ', 'flag' => 'in.png'],
            'ur' => ['name' => 'اردو', 'flag' => 'pk.png'],
            'it' => ['name' => 'Italiano', 'flag' => 'it.png'],
            'ko' => ['name' => '한국어', 'flag' => 'kr.png'],
            'tr' => ['name' => 'Türkçe', 'flag' => 'tr.png'],
            'vi' => ['name' => 'Tiếng Việt', 'flag' => 'vn.png'],
            'nl' => ['name' => 'Nederlands', 'flag' => 'nl.png'],
            'th' => ['name' => 'ไทย', 'flag' => 'th.png'],
            'ms' => ['name' => 'Bahasa Melayu', 'flag' => 'my.png'],
            'id' => ['name' => 'Bahasa Indonesia', 'flag' => 'id.png'],
            // add more as needed
        ];
    }
}

