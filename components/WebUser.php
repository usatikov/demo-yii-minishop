<?php
/**
 * Represents the state for a Web application user
 */
class WebUser extends CWebUser
{
    /**
     * Add a product into the cart. Cart is stored into default php-session.
     * All the information are stored, including names and prices of products.
     * This is some kind of optimization for high load. Session should be saved via Memcached.
     * So, adding products and getting full information about the cart will work really fast.
     * @param int $id ID of product
     * @param string $name Name of product
     * @param double $price Price of product
     * @return array User's cart after adding the product
     */
    public function addProduct($id, $name, $price)
    {
        $cart = $this->getCart();

        $quantity = array_key_exists($id, $cart) ? $cart[$id]['quantity'] : 0;
        $quantity += 1;

        $cart[$id] = [
            'name' => $name,
            'price' => $price,
            'quantity' => $quantity,
            'amount' => $quantity * $price,
        ];

        Yii::app()->session->add('cart', $cart);

        return $cart;
    }

    /**
     * @return array Current user's cart
     */
    public function getCart()
    {
        return Yii::app()->session->get('cart', []);
    }
}
