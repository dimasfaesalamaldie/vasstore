<?php
namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class DataPrint extends Model
{
    public $search;

    private $_user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['search', 'safe'],
        ];
    }
}
