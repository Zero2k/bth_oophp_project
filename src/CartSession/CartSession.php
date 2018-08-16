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
     * Add new product.
     *
     * @param string $productId
     * @param string $size
     * @param integer $quantity
     *
     * @return array
     */
    public function addProduct($productId, $name, $image, $available, $quantity, $size, $price)
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
            "productId" => $productId,
            "name" => $name,
            "image" => $image,
            "available" => $available,
            "quantity" => $quantity,
            "size" => $size,
            "price" => $quantity * $price,
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
        $allProducts = $this->session->get(self::KEY);
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
}
