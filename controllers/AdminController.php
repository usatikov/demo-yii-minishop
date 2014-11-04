<?php
/**
 * Controller to manage products.
 * Mainly default YII auto-generated code with some minor modifications.
 */
class AdminController extends Controller
{
    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return [
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        ];
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return [
            // allow admin user to perform all actions
            ['allow', 'users' => ['admin']],

            // allow all users to perform 'login' action
            ['allow', 'actions' => ['login'], 'users' => ['*']],

            // deny other actions for other users
            ['deny', 'users' => ['*']],
        ];
    }

    /**
     * Creates a new product
     */
    public function actionCreate()
    {
        $model = new Product;

        if ($this->processForm($model)) {
            $this->redirect(['update', 'id' => $model->id]);
        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates a particular product.
     * @param integer $id the ID of the product to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        $this->processForm($model);

        $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Process POST data from the form, change attributes of the product and save it.
     * @param Product $product
     * @return bool Has been the product saved
     */
    private function processForm(Product $product)
    {
        if (!isset($_POST['Product'])) {

            return false;
        }

        $product->attributes = $_POST['Product'];
        $product->image = CUploadedFile::getInstance($product, 'image');

        if ($product->save() == false) {

            return false;
        }

        if ($product->image) {
            Yii::app()->images->save($product->id, $product->image);
        }

        Yii::app()->user->setFlash('success', 'Product has been saved');

        return true;
    }

    /**
     * Deletes a particular product
     * @param integer $id the ID of the product to be deleted
     */
    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        Yii::app()->images->delete($model->id);
        $model->delete();

        // if AJAX request (triggered by deletion via admin grid view], we should not redirect the browser
        if (!isset($_GET['ajax'])) {
            $this->redirect(['index']);
        }
    }

    /**
     * Manages all products
     */
    public function actionIndex()
    {
        $model = new Product('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Product'])) {
            $model->attributes = $_GET['Product'];
        }

        $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Product the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Product::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested product does not exist.');
        }

        return $model;
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];

            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('login', ['model' => $model]);
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}
