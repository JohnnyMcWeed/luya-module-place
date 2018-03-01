<?php

namespace johnnymcweed\place\admin;

/**
 * Place Admin Module.
 *
 * File has been created with `module/create` command. 
 */
class Module extends \luya\admin\base\Module
{
    public $apis = [
        'api-place-country' => 'johnnymcweed\place\admin\apis\CountryController',
        'api-place-region' => 'johnnymcweed\place\admin\apis\RegionController',
        'api-place-city' => 'johnnymcweed\place\admin\apis\CityController',
        'api-place-place' => 'johnnymcweed\place\admin\apis\PlaceController',
    ];

    public function getMenu()
    {
        return (new \luya\admin\components\AdminMenuBuilder($this))
            ->node(self::t('Place'), 'place')
            ->group(self::t('Place'))
            ->itemApi(self::t('Country'), 'placeadmin/country/index', 'map', 'api-place-country')
            ->itemApi(self::t('Region'), 'placeadmin/region/index', 'terrain', 'api-place-region')
            ->itemApi(self::t('City'), 'placeadmin/city/index', 'store', 'api-place-city')
            ->itemApi(self::t('Place'), 'placeadmin/place/index', 'place', 'api-place-place');
    }

    public static function onLoad()
    {
        self::registerTranslation('placeadmin', '@placeadmin/messages', [
            'placeadmin' => 'placeadmin.php',
        ]);
    }

    /**
     * Translate place messages.
     *
     * @param string $message
     * @param array $params
     * @return string
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('placeadmin', $message, $params);
    }
}