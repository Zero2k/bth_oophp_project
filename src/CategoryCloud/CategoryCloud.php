<?php

namespace Vibe\CategoryCloud;

/**
 * CategoryCloud class to generate a cloud from categories.
 */
class CategoryCloud
{
    /**
    * @param array $categories
    */
    public function generateCloud($categories)
    {
        $cloud = "";
        foreach ($categories as $category) {
            // determine the popularity of this category as a percentage
            $percent = floor(($category->total / count($categories)) * 100);
            // determine the class for this term based on the percentage
            if ($percent < 20) {
                $class = 'smallest'; 
            } elseif ($percent >= 20 and $percent < 40) {
                $class = 'small'; 
            } elseif ($percent >= 40 and $percent < 60) {
                $class = 'medium';
            } elseif ($percent >= 60 and $percent < 80) {
                $class = 'large';
            } else {
                $class = 'largest';
            }

            $cloud .= "<a class='$class' href='index.php/shop?category=$category->category'>$category->category</a>";
        }

        return $cloud;
    }
}
