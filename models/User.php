<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $iron_horse_id
 * @property integer $name
 * @property string $pass_hash
 * @property string $email
 * @property integer $phone
 * @property string $avatar
 * @property string $date_create
 * @property string $date_update
 */
class User extends ActiveRecord implements IdentityInterface
{

    public $pass;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                   ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                   ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
                //'value' => new Expression('NOW()'),
            ]
        ];
    }

    public function register()
    {
        if (!$this->validate()){
            return false;
        }
        $this->pass_hash = Yii::$app->security->generatePasswordHash($this->pass);
        return $this->save(false);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name', 'pass', 'email', 'phone'], 'required'],
            [['pass'],'string', 'max'=> 255],
            [['phone'], 'integer'],
            [['name', 'email'], 'unique', 'targetClass' => User::className()],
            ['email','email'],
            [['date_create', 'date_update'], 'safe'],
            [[ 'avatar'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'iron_horse_id' => Yii::t('app', 'Iron Horse ID'),
            'name' => Yii::t('app', 'Name'),
            'pass_hash' => Yii::t('app', 'Password'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'avatar' => Yii::t('app', 'Avatar'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_update' => Yii::t('app', 'Date Update'),
        ];
    }



    public static function findIdentity($id){

        return User::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null){}

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey(){}

    public function validateAuthKey($authKey){}



}
