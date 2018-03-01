<?php

namespace johnnymcweed\place\admin\apis;

/**
 * Place Controller.
 * 
 * File has been created with `crud/create` command. 
 */
class PlaceController extends \luya\admin\ngrest\base\Api
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'johnnymcweed\place\models\Place';
}