<?php

namespace johnnymcweed\place\models;

use johnnymcweed\place\admin\Module;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Country.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property integer $continent_id
 * @property string $iso2
 * @property string $iso3
 * @property string $title
 * @property text $text
 * @property text $teaser_text
 * @property integer $image_id
 */
class Country extends NgRestModel
{
    const AFRICA = 1;
    const ANTARCTICA = 2;
    const ASIA = 3;
    const AUSTRALIA = 4;
    const EUROPE = 5;
    const NORTH_AMERICA = 6;
    const SOUTH_AMERICA = 7;

    /**
     * @inheritdoc
     */
    public $i18n = ['title', 'text', 'teaser_text', 'slug', 'seo_title', 'seo_description'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place_country';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-place-country';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'continent_id' => Module::t('Continent'),
            'iso2' => Module::t('ISO 2'),
            'iso3' => Module::t('ISO 3'),
            'title' => Module::t('Title'),
            'text' => Module::t('Text'),
            'teaser_text' => Module::t('Teaser Text'),
            'slug' => Module::t('Slug'),
            'seo_title' => Module::t('Title'),
            'seo_description' => Module::t('Description'),
            'image_id' => Module::t('Image'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['continent_id'], 'integer'],
            [['image_id'], 'safe'],
            [['title', 'text', 'teaser_text', 'slug', 'seo_title', 'seo_description',], 'string'],
            [['iso2'], 'string', 'max' => 2],
            [['iso3'], 'string', 'max' => 3],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['title', 'iso2', 'iso3',];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeGroups()
    {
        return [
            [['text', 'teaser_text'], Module::t('Description')],
            [['slug', 'seo_title', 'seo_description'], Module::t('SEO'), 'collapsed' => true],
            [['iso2', 'iso3', 'continent_id'], Module::t('Info'), 'collapsed' => true],
            [['image_id'], Module::t('Media'), 'collapsed' => true],
        ];
    }


    public function ngRestFilters()
    {
        return [
            Module::t('Africa') => self::find()->where(['=', 'continent_id', self::AFRICA]),
            Module::t('Antarctica') => self::find()->where(['=', 'continent_id', self::ANTARCTICA]),
            Module::t('Asia') => self::find()->where(['=', 'continent_id', self::ASIA]),
            Module::t('Australia') => self::find()->where(['=', 'continent_id', self::AUSTRALIA]),
            Module::t('Europe') => self::find()->where(['=', 'continent_id', self::EUROPE]),
            Module::t('North America') => self::find()->where(['=', 'continent_id', self::NORTH_AMERICA]),
            Module::t('South America') => self::find()->where(['=', 'continent_id', self::SOUTH_AMERICA]),
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'continent_id' => [
                'selectArray',
                'data' => [
                    self::AFRICA => Module::t('Africa'),
                    self::ANTARCTICA => Module::t('Antarctica'),
                    self::ASIA => Module::t('Asia'),
                    self::AUSTRALIA => Module::t('Australia'),
                    self::EUROPE => Module::t('Europe'),
                    self::NORTH_AMERICA => Module::t('North America'),
                    self::SOUTH_AMERICA => Module::t('South America'),
                ]
            ],
            'iso2' => 'text',
            'iso3' => 'text',
            'title' => 'text',
            'text' => 'textarea',
            'teaser_text' => 'textarea',
            'image_id' => 'image',
            'slug' => 'slug',
            'seo_title' => 'text',
            'seo_description' => 'textarea',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['title', 'iso2', 'iso3', 'continent_id']],
            [['create', 'update'], ['title', 'iso2', 'iso3', 'slug', 'seo_title', 'seo_description', 'continent_id', 'text', 'teaser_text', 'image_id']],
            ['delete', false],
        ];
    }
}