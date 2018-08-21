<?php

namespace Vibe\CartSession;

use \Anax\DI\InjectionAwareInterface;
use \Anax\DI\InjectionAwareTrait;
use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;

/**
 * CartSession.
 */

class CartSession implements ConfigureInterface, InjectionAwareInterface
{
    use ConfigureTrait;
    use InjectionAwareTrait;

    /**
     * @var array $session inject a reference to the session.
     */

    private $session;
    
    
    /**
     * @var string $key to use when storing in session.
     */
    const KEY = "cart";



        /**
     * Inject dependencies.
     *
     * @param array $dependency key/value array with dependencies.
     *
     * @return self
     */
    public function inject($dependency)
    {
        $this->session = $dependency["session"];
        return $this;
    }



    /**
     * Save (the modified) dataset.
     *
     * @param string $dataset the data to save.
     *
     * @return self
     */
    public function saveDataset($dataset)
    {
        $this->session->set(self::KEY, $dataset);
        return $this;
    }



    /**
     * Get all products saved in session.
     *
     * @return array with the dataset
     */
    public function getProducts()
    {
        $data = $this->session->get(self::KEY);
        $set = isset($data)
            ? $data
            : [];
        return $set;
    }



    /**
     * Get single product saved in session.
     *
     * @return array with the dataset
     */
    public function getProduct($key)
    {
        $data = $this->session->get(self::KEY);
        $set = isset($data[$key])
            ? $data[$key]
            : [];
        return $set;
    }



    /**
     * Add new product.
     *
     * @param object $product
     * @param integer $quantity
     * @param string $size
     *
     * @return array
     */
    public function addProduct($product, $quantity, $size)
    {
        $allProducts = $this->session->get(self::KEY);

        $id = 0;

        foreach ($allProducts as $value) {
            if ($id < $value["id"]) {
                $id = $value["id"];
            }
        }

        $product = [
            "id" => ($id + 1),
            "productId" => $product->id,
            "name" => $product->name,
            "image" => $product->image,
            "available" => ($product->stock - $quantity < 0 ? 0 : 1),
            "quantity" => $quantity,
            "size" => $size,
            "price" => $quantity * $product->price,
        ];

        $allProducts[] = $product;

        $this->saveDataset($allProducts);
        return $product;
    }



    /**
     * Update product.
     *
     * @param string $id
     * @param integer $quantity
     * @param integer $size
     *
     * @return array
     */
    public function updateProductRow($id, $quantity, $size)
    {
        $allProducts = $this->session->getProduct($id);
        // Find the comment if id exists

        $this->saveDataset($allProducts);
    }



    /**
     * Remove product.
     *
     * @param string $id
     *
     * @return array
     */
    public function removeProduct($id)
    {
        $allProducts = $this->session->get(self::KEY);
        // Find the comment if id exists
        foreach ($allProducts as $key => $value) {
            if ($value["id"] == $id) {
                unset($allProducts[$key]);
            }
        }
        $this->saveDataset($allProducts);
    }



    public function productExists($productId, $size)
    {
        $allProducts = $this->session->get(self::KEY);
        $exist = null;

        if (!$allProducts) {
            $exist = null;
        } else {
            foreach ($allProducts as $product) {
                if ($product["productId"] == $productId && $product["size"] == $size) {
                    $exist = $product;
                }
            }
        }

        return $exist;
    }



    public function calculateTotal()
    {
        $allProducts = $this->session->get(self::KEY);

        if (!$allProducts) {
            $prices = 0;
        } else {
            $prices = array_sum(array_column($allProducts, 'price'));
        }


        return $prices;
    }
}
