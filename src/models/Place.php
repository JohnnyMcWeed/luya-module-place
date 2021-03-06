<?php

namespace johnnymcweed\place\models;

use johnnymcweed\place\admin\Module;
use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Place.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $title
 * @property string $street
 * @property string $nr
 * @property float $lat
 * @property float $lng
 * @property text $teaser_text
 * @property integer $image_id
 * @property text $image_list
 * @property text $file_list
 */
class Place extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['title', 'text', 'teaser_text', 'slug', 'seo_title', 'seo_description', 'image_list', 'file_list'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place_place';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-place-place';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'city_id' => Module::t('City'),
            'title' => Module::t('Title'),
            'street' => Module::t('Street'),
            'nr' => Module::t('Nr'),
            'lat' => Module::t('Lat'),
            'lng' => Module::t('Lng'),
            'text' => Module::t('Text'),
            'teaser_text' => Module::t('Teaser Text'),
            'slug' => Module::t('Slug'),
            'seo_title' => Module::t('Title'),
            'seo_description' => Module::t('Description'),
            'image_id' => Module::t('Image'),
            'image_list' => Module::t('Image List'),
            'file_list' => Module::t('File List'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['title', 'street', 'nr', 'text', 'teaser_text', 'slug', 'seo_title', 'seo_description', 'image_list', 'file_list'], 'string'],
            [['image_id'], 'safe'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['title', 'street', 'nr', 'city_id'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'city_id' => [
                'selectModel',
                'modelClass' => City::className(),
                'valueField' => 'id',
                'labelField' => 'title',
            ],
            'title' => 'text',
            'street' => 'text',
            'nr' => 'text',
            'lat' => 'decimal',
            'lng' => 'decimal',
            'text' => 'textarea',
            'teaser_text' => 'textarea',
            'image_id' => 'image',
            'image_list' => 'imageArray',
            'file_list' => 'fileArray',
            'slug' => 'slug',
            'seo_title' => 'text',
            'seo_description' => 'textarea',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeGroups()
    {
        return [
            [['text', 'teaser_text'], 'Description'],
            [['slug', 'seo_title', 'seo_description'], Module::t('SEO'), 'collapsed' => true],
            [['street', 'nr', 'city_id', 'lat', 'lng'], Module::t('Info'), 'collapsed' => true],
            [['image_id', 'image_list', 'file_list'], Module::t('Media'), 'collapsed' => true],
        ];
    }

    // TODO: Filter by country, region and city

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['title', 'street', 'nr', 'city_id']],
            [['create', 'update'], ['title', 'street', 'nr', 'city_id', 'lat', 'lng', 'text', 'teaser_text', 'slug', 'seo_title', 'seo_description', 'image_id', 'image_list', 'file_list']],
            ['delete', false],
        ];
    }
}