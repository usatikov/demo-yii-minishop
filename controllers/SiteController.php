<?php
/**
 * Main site controller.
 * Provide actions to overview of products, view details, add products into the cart etc.
 */
class SiteController extends Controller
{
    /**
     * Overview of products
     */
    public function actionIndex()
    {
        $this->render('index', [
            'dataProvider' => $this->dataProvider(0),
        ]);
    }

    /**
     * View product's details
     * @param int $id the ID of the protuct to be showed
     * @throws CHttpException If the product does not exist
     */
    public function actionDetails($id)
    {
        // ActiveRecord is not too slow, when only one item is fetched
        // So, sometimes we can use it in spite of high load
        $product = Product::model()->findByPk($id);

        if (!$product) {
            throw new CHttpException(404, "The requested product does not exist");
        }

        if (Yii::app()->request->isAjaxRequest) {
            $this->layout = false;
        }

        $this->render('details', [
            'product' => $product,
        ]);
    }

    /**
     * Generates a list of products after given offset.
     * Offset is a special identifier provided by ProductProvider::getNextOffset()
     * @param int $offset
     */
    public function actionMore($offset)
    {
        $this->renderResponse('_products', [
            'dataProvider' => $this->dataProvider($offset)
        ]);
    }

    /**
     * Add a product into user's cart
     * @param int $id the ID of the model to be added
     * @throws CHttpException If the product does not exist
     */
    public function actionAdd($id)
    {
        // This is an example of optimization.
        // Instead of using ActiveRecord::findByPk, with may be slow in some cases,
        // we implement our own method to fetch data faster.
        // By the way, in this particular case I would use findByPk, like at actionDetails(). This is just an example.
        $product = Product::model()->oneBasicData($id);
        if (!$product) {
            throw new CHttpException(404, "The requested product does not exist");
        }

        $products = Yii::app()->user->addProduct($product['id'], $product['name'], $product['price']);

        // Maybe not the fastest way to count full amount, but really elegant and clean
        $fullAmount = array_sum(array_column($products, 'amount'));

        $this->renderResponse('add', [
            'products' => $products,
            'fullAmount' => $fullAmount,
        ]);
    }

    /**
     * Renders action's response. Determine, is there an AJAX request and according to that use or don't use layout
     * @param string $view Name of a view file
     * @param array $params Rendering parameters
     */
    private function renderResponse($view, $params)
    {
        if (Yii::app()->request->isAjaxRequest) {
            $this->renderPartial($view, $params);
        }
        else {
            $this->render($view, $params);
        }
    }

    /**
     * Generates data provider by given offset
     * @param int $offset Special identifier provided by ProductProvider::getNextOffset()
     * @return ProductProvider
     */
    private function dataProvider($offset = 0)
    {
        $limit = Yii::app()->params['pageSize'];

        // ProductProvider contains only necessary data, so we can fully cache it.
        // In this particular case it is only an example. ProductProvider is fast itself and caching is not necessary.
        $cacheKey = "dataProvider-$offset-$limit";
        $provider = Yii::app()->cache->get($cacheKey);

        if ($provider === false) {
            $provider = new ProductProvider($offset, $limit);
            Yii::app()->cache->set($cacheKey, $provider, Yii::app()->params['cacheDuration']);
        }

        return $provider;
    }

    /**
     * This is the action to handle external exceptions.
     * Default YII implementation.
     */
    public function actionError()
    {
        $error = Yii::app()->errorHandler->getError();

        if (!$error) {

            return;
        }

        if (Yii::app()->request->isAjaxRequest) {
            echo $error['message'];
        }
        else {
            $this->render('error', $error);
        }
    }
}
