<?php

namespace johnnymcweed\place\models;

use johnnymcweed\place\admin\Module;
use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * City.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property integer $region_id
 * @property string $title
 * @property string $zip
 * @property text $text
 * @property text $teaser_text
 * @property integer $image_id
 */
class City extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['title', 'text', 'teaser_text'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place_city';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-place-city';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'region_id' => Module::t('Region ID'),
            'title' => Module::t('Title'),
            'zip' => Module::t('Zip'),
            'text' => Module::t('Text'),
            'teaser_text' => Module::t('Teaser Text'),
            'image_id' => Module::t('Image ID'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['region_id'], 'integer'],
            [['title', 'zip', 'text', 'teaser_text'], 'string'],
            [['image_id'], 'safe'],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['title', 'zip', 'text', 'teaser_text'];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'region_id' => [
                'selectModel',
                'modelClass' => Region::className(),
                'valueField' => 'id',
                'labelField' => 'title',
            ],
            'title' => 'text',
            'zip' => 'text',
            'text' => 'textarea',
            'teaser_text' => 'textarea',
            'image_id' => 'image',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeGroups()
    {
        return [
            [['text', 'teaser_text'], Module::t('Description')],
            [['zip', 'region_id'], Module::t('Info'), 'collapsed' => true],
            [['image_id'], Module::t('Media'), 'collapsed' => true],
        ];
    }

    // TODO: Filter by country & region

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['title', 'zip', 'region_id',]],
            [['create', 'update'], ['title', 'zip', 'region_id', 'text', 'teaser_text', 'image_id']],
            ['delete', false],
        ];
    }
}