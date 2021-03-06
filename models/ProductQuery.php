<?php

namespace app\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[Product]].
 *
 * @see Product
 */
class ProductQuery extends ActiveQuery
{
    /**
     * @return ProductQuery
     */
    public function active()
    {
        return $this->andWhere(['status' => CustomActiveRecord::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     * @return Product[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Product|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return array
     */
//    public function getListProducts()
//    {
//        return $this->select(['title', 'id'])
//            ->active()
//            ->indexBy('id')
//            ->orderBy('title')
//            ->column();
//    }
}
