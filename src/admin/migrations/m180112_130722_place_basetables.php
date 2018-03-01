<?php
use yii\db\Migration;

/**
 * Class m180112_130722_basetables
 */
class m180112_130722_place_basetables extends Migration
{
    public function safeUp()
    {
        $this->createTable('place_country', [
            'id' => $this->primaryKey(),
            'continent_id' => $this->integer(),
            'iso2' => $this->string(2),
            'iso3' => $this->string(3),
            'title' => $this->string(),
            'text' => $this->text(),
            'teaser_text' => $this->text(),
            'image_id' => $this->integer(11)->defaultValue(0),
        ]);

        $this->createTable('place_region', [
            'id' => $this->primaryKey(),
            'country_id' => $this->integer(),
            'title' => $this->string(),
            'code' => $this->string(),
            'text' => $this->text(),
            'teaser_text' => $this->text(),
            'image_id' => $this->integer(11)->defaultValue(0),
        ]);

        $this->addForeignKey('fk-place_region-country_id',
            'place_region', 'country_id',
            'place_country', 'id',
            'SET NULL', 'CASCADE'
        );

        $this->createTable('place_city', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer(),
            'title' => $this->string(),
            'zip' => $this->string(),
            'text' => $this->text(),
            'teaser_text' => $this->text(),
            'image_id' => $this->integer(11)->defaultValue(0),
        ]);

        $this->addForeignKey('fk-place_city-region_id',
            'place_city', 'region_id',
            'place_region', 'id',
            'SET NULL', 'CASCADE'
        );

        $this->createTable('place_place', [
            'id' => $this->primaryKey(),
            'city_id' => $this->integer(),
            'title' => $this->string(),
            'street' => $this->string(),
            'nr' => $this->string(),
            'lat' => $this->float(),
            'lng' => $this->float(),
            'text' => $this->string(),
            'teaser_text' => $this->text(),
            'image_id' => $this->integer(11)->defaultValue(0),
            'image_list' => $this->text(),
            'file_list' => $this->text(),
        ]);

        $this->addForeignKey('fk-place_place-city_id',
            'place_place', 'city_id',
            'place_city', 'id',
            'SET NULL', 'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-place_place-city_id','place_place');
        $this->dropTable('place_place');
        $this->dropForeignKey('fk-place_city-region_id','place_city');
        $this->dropTable('place_city');
        $this->dropForeignKey('fk-place_region-country_id','place_region');
        $this->dropTable('place_region');
        $this->dropTable('place_country');
    }
}