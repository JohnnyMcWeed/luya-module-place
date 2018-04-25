<?php

use yii\db\Migration;

/**
 * Class m180425_162808_add_seo_fields
 */
class m180425_162808_add_seo_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('place_country','slug', $this->text());
        $this->addColumn('place_country','seo_title', $this->text());
        $this->addColumn('place_country','seo_description', $this->text());

        $this->addColumn('place_region','slug', $this->text());
        $this->addColumn('place_region','seo_title', $this->text());
        $this->addColumn('place_region','seo_description', $this->text());

        $this->addColumn('place_city','slug', $this->text());
        $this->addColumn('place_city','seo_title', $this->text());
        $this->addColumn('place_city','seo_description', $this->text());

        $this->addColumn('place_place','slug', $this->text());
        $this->addColumn('place_place','seo_title', $this->text());
        $this->addColumn('place_place','seo_description', $this->text());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('place_place','slug');
        $this->dropColumn('place_place','seo_title');
        $this->dropColumn('place_place','seo_description');

        $this->dropColumn('place_city','slug');
        $this->dropColumn('place_city','seo_title');
        $this->dropColumn('place_city','seo_description');

        $this->dropColumn('place_region','slug');
        $this->dropColumn('place_region','seo_title');
        $this->dropColumn('place_region','seo_description');

        $this->dropColumn('place_country','slug');
        $this->dropColumn('place_country','seo_title');
        $this->dropColumn('place_country','seo_description');
    }
}
