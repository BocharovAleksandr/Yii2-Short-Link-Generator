<?php

namespace app\models;

use yii\db\ActiveRecord;

class Link extends ActiveRecord
{
    public static function tableName()
    {
        return 'links';
    }

    public static function findByUrl($url)
    {
        $search_data = [$url];

        if(substr($url, 0, 4) != 'http'){
            $search_data[] = 'https://' . $url;
            $search_data[] = 'http://' . $url;
        }

        return static::findOne(['url' => $search_data]);
    }

    public static function findByAlias($alias)
    {
        return static::findOne(['alias' => $alias]);
    }

    public function rules()
    {
        return [
            ['url', 'url', 'defaultScheme' => 'http'],
        ];
    }
}
