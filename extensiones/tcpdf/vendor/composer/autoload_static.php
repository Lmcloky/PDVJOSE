<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4640ba8d0c8b7651f65a568f48fc526d
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'Luecano\\NumeroALetras\\' => 22,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Luecano\\NumeroALetras\\' => 
        array (
            0 => __DIR__ . '/..' . '/luecano/numero-a-letras/src',
        ),
    );

    public static $classMap = array (
        'Datamatrix' => __DIR__ . '/../..' . '/include/barcodes/datamatrix.php',
        'PDF417' => __DIR__ . '/../..' . '/include/barcodes/pdf417.php',
        'QRcode' => __DIR__ . '/../..' . '/include/barcodes/qrcode.php',
        'TCPDF' => __DIR__ . '/../..' . '/tcpdf.php',
        'TCPDF2DBarcode' => __DIR__ . '/../..' . '/tcpdf_barcodes_2d.php',
        'TCPDFBarcode' => __DIR__ . '/../..' . '/tcpdf_barcodes_1d.php',
        'TCPDF_COLORS' => __DIR__ . '/../..' . '/include/tcpdf_colors.php',
        'TCPDF_FILTERS' => __DIR__ . '/../..' . '/include/tcpdf_filters.php',
        'TCPDF_FONTS' => __DIR__ . '/../..' . '/include/tcpdf_fonts.php',
        'TCPDF_FONT_DATA' => __DIR__ . '/../..' . '/include/tcpdf_font_data.php',
        'TCPDF_IMAGES' => __DIR__ . '/../..' . '/include/tcpdf_images.php',
        'TCPDF_IMPORT' => __DIR__ . '/../..' . '/tcpdf_import.php',
        'TCPDF_PARSER' => __DIR__ . '/../..' . '/tcpdf_parser.php',
        'TCPDF_STATIC' => __DIR__ . '/../..' . '/include/tcpdf_static.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4640ba8d0c8b7651f65a568f48fc526d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4640ba8d0c8b7651f65a568f48fc526d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4640ba8d0c8b7651f65a568f48fc526d::$classMap;

        }, null, ClassLoader::class);
    }
}
