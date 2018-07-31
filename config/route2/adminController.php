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
    ]
];
