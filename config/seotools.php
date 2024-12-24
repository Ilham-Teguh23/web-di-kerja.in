<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "Jasa Pembuatan Aplikasi dan Website Profesional dengan Harga Terjangkau, Berkualitas dan Terpercaya", // set false to total remove
            'titleBefore'  => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => 'Kami menyediakan jasa pembuatan aplikasi mobile dan website profesional untuk kebutuhan bisnis Anda. Tim ahli siap membantu Anda.',
            'separator'    => ' | ',
            'keywords'     => [
                'jasa pembuatan aplikasi',
                'jasa pembuatan website',
                'joki murah laravel',
                'joki murah php',
                'joki program murah',
                'joki skripsi',
                'joki tugas akhir',
                'joki tugas magang'
            ],
            'canonical'    => false, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Jasa Pembuatan Aplikasi dan Website Profesional dengan Harga Terjangkau, Berkualitas dan Terpercaya',
            'description' => 'Kami menyediakan jasa pembuatan aplikasi mobile dan website profesional untuk kebutuhan bisnis Anda. Tim ahli siap membantu Anda.', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => 'website',
            'site_name'   => 'Jasa Dev',
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card'        => 'summary_large_image',
            'site'        => '@HameTR29',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            '@context'     => 'https://schema.org',
            'title'       => 'Over 9000 Thousand!', // set false to total remove
            'description' => 'Kami menyediakan jasa pembuatan aplikasi mobile dan website profesional untuk kebutuhan bisnis Anda. Tim ahli siap membantu Anda.',
            'url'         => null, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            '@type'        => 'WebPage',
            'images'      => [],
            'name'        => 'Jasa Pembuatan Aplikasi dan Website Profesional dengan Harga Terjangkau, Berkualitas dan Terpercaya'
        ],
    ],
];
