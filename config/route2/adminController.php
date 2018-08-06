<?php
/**
 * Routes for admin controller.
 */
return [
    "routes" => [
        [
            "info" => "Admin.",
            "requestMethod" => "get|post",
            "path" => "admin",
            "callable" => ["adminController", "getAdmin"],
        ],
        [
            "info" => "Admin - Add User",
            "requestMethod" => "get|post",
            "path" => "admin/add/user",
            "callable" => ["adminController", "getAdminAddUser"],
        ],
        [
            "info" => "Admin - Change User",
            "requestMethod" => "get|post",
            "path" => "admin/edit/user/{id:digit}",
            "callable" => ["adminController", "getAdminEditUser"],
        ],
        [
            "info" => "Admin - Delete User",
            "requestMethod" => "get|post",
            "path" => "admin/delete/user/{id:digit}",
            "callable" => ["adminController", "getAdminDeleteUser"],
        ],
        [
            "info" => "Admin - Add Post",
            "requestMethod" => "get|post",
            "path" => "admin/add/post",
            "callable" => ["adminController", "getAdminAddPost"],
        ],
        [
            "info" => "Admin - Change Post",
            "requestMethod" => "get|post",
            "path" => "admin/edit/post/{id:digit}",
            "callable" => ["adminController", "getAdminEditPost"],
        ],
        [
            "info" => "Admin - Delete Post",
            "requestMethod" => "get|post",
            "path" => "admin/delete/post/{id:digit}",
            "callable" => ["adminController", "getAdminDeletePost"],
        ],
        [
            "info" => "Admin - Add Product",
            "requestMethod" => "get|post",
            "path" => "admin/add/product",
            "callable" => ["adminController", "getAdminAddProduct"],
        ],
        [
            "info" => "Admin - Change Product",
            "requestMethod" => "get|post",
            "path" => "admin/edit/product/{id:digit}",
            "callable" => ["adminController", "getAdminEditProduct"],
        ],
        [
            "info" => "Admin - Delete Product",
            "requestMethod" => "get|post",
            "path" => "admin/delete/product/{id:digit}",
            "callable" => ["adminController", "getAdminDeleteProduct"],
        ],
    ]
];
