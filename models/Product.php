<?php
/**
 * The model for a product.
 * Provide methods to fetch data.
 *
 * The followings are the available columns in table 'product':
 * @property string $id
 * @property string $name
 * @property string $price
 * @property string $description
 */
class Product extends CActiveRecord
{
    /** @var CUploadedFile|null Product's image or null, if it is not received from the user */
    public $image;

    /**
     * @return string The associated database table name
     */
    public function tableName()
    {
        return '{{product}}';
    }

    /**
     * Fetch basic info about products: id, name, price
     * @param int $afterId Only products with ID greater or equal to given will be fetched
     * @param int $limit How many products should be fetched
     * @return array
     */
    public function basicData($afterId = 0, $limit = 10)
    {
        return $this->getDbConnection()->createCommand()
            ->select('id, name, price')->from($this->tableName())
            ->where('id >= :afterId', [':afterId' => $afterId])
            ->order('id')
            ->limit($limit)
            ->queryAll();
    }

    /**
     * Fetch basic info about one product: id, name, price
     * An example of optimized data fetching without generating full ActiveRecordt object
     * @param int $id the ID of the product to be showed
     * @return array
     */
    public function oneBasicData($id)
    {
        return $this->getDbConnection()->createCommand()
            ->select('id, name, price')->from($this->tableName())
            ->where('id = :id', [':id' => $id])
            ->queryRow();
    }

    /**
     * @return array Validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['name, price, description', 'required'],
            ['name', 'length', 'max' => 100],
            ['price', 'length', 'max' => 9],

            ['image', 'required', 'on' => 'insert'],
            ['image', 'file', 'types' => ['jpg', 'jpeg'], 'allowEmpty' => true],

            // The following rule is used by search().
            ['id, name, price, description', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array Customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'description' => 'Description',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * Can be pretty slow, so this method used only in AdminController
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('price', $this->price, true);
        $criteria->compare('description', $this->description, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
