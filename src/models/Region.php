<?php

namespace johnnymcweed\place\models;

use johnnymcweed\place\admin\Module;
use Yii;
use luya\admin\ngrest\base\NgRestModel;

/**
 * Region.
 * 
 * File has been created with `crud/create` command. 
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $title
 * @property string $code
 * @property text $text
 * @property text $teaser_text
 * @property integer $image_id
 */
class Region extends NgRestModel
{
    /**
     * @inheritdoc
     */
    public $i18n = ['title', 'code', 'text', 'teaser_text'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'place_region';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-place-region';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Module::t('ID'),
            'country_id' => Module::t('Country'),
            'title' => Module::t('Title'),
            'code' => Module::t('Code'),
            'text' => Module::t('Text'),
            'teaser_text' => Module::t('Teaser Text'),
            'image_id' => Module::t('Image'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id'], 'integer'],
            [['title', 'code', 'text', 'teaser_text'], 'string'],
            [['image_id'], 'safe'],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function genericSearchFields()
    {
        return ['title', 'code',];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'country_id' => [
                'selectModel',
                'modelClass' => Country::className(),
                'valueField' => 'id',
                'labelField' => 'title',
            ],
            'title' => 'text',
            'code' => 'text',
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
            [['code', 'country_id'], Module::t('Info'), 'collapsed' => true],
            [['image_id'], Module::t('Media'), 'collapsed' => true],
        ];
    }

    // TODO: Filter by country

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['title', 'code', 'country_id']],
            [['create', 'update'], ['title', 'code', 'country_id', 'text', 'teaser_text', 'image_id']],
            ['delete', false],
        ];
    }
}