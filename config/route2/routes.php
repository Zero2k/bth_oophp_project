<?php
/**
 * Routes to pages.
 */
return [
    "routes" => [
        [
            "info" => "Home",
            "requestMethod" => null,
            "path" => "/",
            "callable" => ["pageController", "getIndex"],
        ],
        [
            "info" => "Shop",
            "requestMethod" => null,
            "path" => "shop",
            "callable" => ["pageController", "getShop"],
        ],
        [
            "info" => "About",
            "requestMethod" => null,
            "path" => "about",
            "callable" => ["pageController", "getAbout"],
        ],
        [
            "info" => "Blog",
            "requestMethod" => null,
            "path" => "blog",
            "callable" => ["pageController", "getBlog"],
        ],
        [
            "info" => "Blog View",
            "requestMethod" => null,
            "path" => "blog/{slug}",
            "callable" => ["pageController", "getBlogView"],
        ],
        [
            "info" => "Contact",
            "requestMethod" => null,
            "path" => "contact",
            "callable" => ["pageController", "getContact"],
        ]
    ]
];
