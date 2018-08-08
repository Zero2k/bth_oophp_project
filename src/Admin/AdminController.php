<?php

namespace Vibe\Admin;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Vibe\User\User;
use \Vibe\Post\Post;
use \Vibe\Product\Product;
use \Vibe\Category\Category;
use \Vibe\Category\CategoryProduct;
use \Vibe\Content\HTMLForm\EditContentForm;

/**
 * A controller class.
 */
class AdminController implements
    ConfigureInterface,
    InjectionAwareInterface
{
    use ConfigureTrait,
        InjectionAwareTrait;



    /**
     * @var $data description
     */
    //private $data;



    public function init()
    {
        $this->user = new User();
        $this->user->setDb($this->di->get("database"));

        $this->post = new Post();
        $this->post->setDb($this->di->get("database"));

        $this->product = new Product();
        $this->product->setDb($this->di->get("database"));

        $this->category = new Category();
        $this->category->setDb($this->di->get("database"));

        $this->categoryProduct = new CategoryProduct();
        $this->categoryProduct->setDb($this->di->get("database"));

        $this->blogImages = scandir("img/blog/");
        $this->shopImages = scandir("img");

        $this->session = $this->di->get("session");
    }



    /**
     * Description.
     *
     * @param datatype $variable Description
     *
     * @throws Exception
     *
     * @return void
     */
    public function getAdmin()
    {
        $this->init();
        $title      = "Admin";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId && $userRole === 1) {
            $tab = isset($_GET["tab"]) ? $_GET["tab"] : '';

            switch ($tab) {
                case 'orders':
                    $data = [
                        "content" => "orders",
                    ];

                    $view->add("admin/partials/orders", $data, "partial");
                    break;

                case 'categories':
                    $data = [
                        "categories" => $this->category->getCategories(10),
                    ];

                    $view->add("admin/partials/categories", $data, "partial");
                    break;

                case 'products':
                    $data = [
                        "products" => $this->product->getProducts(10),
                    ];

                    $view->add("admin/partials/products", $data, "partial");
                    break;

                case 'posts':
                    $data = [
                        "posts" => $this->post->getPosts(10),
                    ];

                    $view->add("admin/partials/posts", $data, "partial");
                    break;

                case 'users':
                    $data = [
                        "users" => $this->user->getUsers(10),
                    ];

                    $view->add("admin/partials/users", $data, "partial");
                    break;

                case 'settings':
                    /* Form to edit about */
                    $about = new EditContentForm($this->di, "about");
                    $about->check();

                    /* Form to edit footer */
                    $footer = new EditContentForm($this->di, "footer");
                    $footer->check();

                
                    $data = [
                        "about" => $about->getHTML(),
                        "footer" => $footer->getHTML(),
                    ];

                    $view->add("admin/partials/settings", $data, "partial");
                    break;

                default:
                    $data = [
                        "content" => $this->user->getUserInfo($userId, 180),
                    ];

                    $view->add("admin/partials/dashboard", $data, "partial");
                    break;
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [
            "userRole" => $userRole,
        ];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/dashboard", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminAddUser()
    {
        $this->init();
        $title      = "Admin - Add User";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId && $userRole === 1) {
            if (!empty($_POST)) {
                $username = isset($_POST["username"]) ? htmlentities($_POST["username"]) : "";
                $email = isset($_POST["email"]) ? htmlentities($_POST["email"]) : "";
                $role = isset($_POST["role"]) ? htmlentities($_POST["role"]) : "";
                $address = isset($_POST["address"]) ? htmlentities($_POST["address"]) : "";
                $city = isset($_POST["city"]) ? htmlentities($_POST["city"]) : "";
                $country = isset($_POST["country"]) ? htmlentities($_POST["country"]) : "";
                $password = isset($_POST["password"]) ? htmlentities($_POST["password"]) : "";
                $confirmPassword = isset($_POST["confirm-password"]) ? htmlentities($_POST["confirm-password"]) : "";

                if ($this->user->userExists($email)) {
                    $this->session->set("message", "Email already exist");
                    $this->di->get("response")->redirect("admin?tab=users");
                }

                if (!$password && $password !== $confirmPassword) {
                    $this->session->set("message", "Password is required and needs to be confirmed!");
                    $this->di->get("response")->redirect("admin?tab=users");
                } else {
                    $this->user->username = mb_strtolower($username, 'UTF-8');
                    $this->user->email = mb_strtolower($email, 'UTF-8');
                    $this->user->admin = mb_strtolower($role, 'UTF-8');
                    $this->user->address = mb_strtolower($address, 'UTF-8');
                    $this->user->city = mb_strtolower($city, 'UTF-8');
                    $this->user->country = mb_strtolower($country, 'UTF-8');
                    $this->user->setPassword($password);
                    $this->user->save();
                }

                $this->session->set("message", "User was successfully added");
                $this->di->get("response")->redirect("admin?tab=users");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/user/new", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminEditUser($id)
    {
        $this->init();
        $title      = "Admin - Edit User";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId && $userRole === 1) {
            $user = $this->user->find("id", $id);

            if (!empty($_POST)) {
                $username = isset($_POST["username"]) ? htmlentities($_POST["username"]) : "";
                $email = isset($_POST["email"]) ? htmlentities($_POST["email"]) : "";
                $role = isset($_POST["role"]) ? htmlentities($_POST["role"]) : "";
                $address = isset($_POST["address"]) ? htmlentities($_POST["address"]) : "";
                $city = isset($_POST["city"]) ? htmlentities($_POST["city"]) : "";
                $country = isset($_POST["country"]) ? htmlentities($_POST["country"]) : "";
                $password = isset($_POST["password"]) ? htmlentities($_POST["password"]) : "";
                $confirmPassword = isset($_POST["confirm-password"]) ? htmlentities($_POST["confirm-password"]) : "";

                if ($email !== $this->user->email && $this->user->userExists($email)) {
                    $this->session->set("message", "Email already exist");
                    $this->di->get("response")->redirect("admin?tab=users");
                }

                if (!$password) {
                    $this->user->username = mb_strtolower($username, 'UTF-8');
                    $this->user->email = mb_strtolower($email, 'UTF-8');
                    $this->user->admin = mb_strtolower($role, 'UTF-8');
                    $this->user->address = mb_strtolower($address, 'UTF-8');
                    $this->user->city = mb_strtolower($city, 'UTF-8');
                    $this->user->country = mb_strtolower($country, 'UTF-8');
                    $this->user->password = $this->user->password;
                } else {
                    if ($password !== $confirmPassword) {
                        $this->session->set("message", "Password didn't match");
                        $this->di->get("response")->redirect("admin?tab=users");
                    }

                    $this->user->username = mb_strtolower($username, 'UTF-8');
                    $this->user->email = mb_strtolower($email, 'UTF-8');
                    $this->user->admin = mb_strtolower($role, 'UTF-8');
                    $this->user->address = mb_strtolower($address, 'UTF-8');
                    $this->user->city = mb_strtolower($city, 'UTF-8');
                    $this->user->country = mb_strtolower($country, 'UTF-8');
                    $this->user->setPassword($password);
                }

                $this->session->set("message", "User has been updated");
                $this->user->save();
                $this->di->get("response")->redirect("admin?tab=users");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [
            "user" => $user,
        ];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/user/edit", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminDeleteUser($id)
    {
        $this->init();
        $title      = "Admin - Delete User";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId && $userRole === 1) {
            $user = $this->user->find("id", $id);

            if (!empty($_POST) && $id !== $userId) {
                $userId = isset($_POST["id"]) ? htmlentities($_POST["id"]) : "";
                $deleteUser = $this->user->find("id", $userId);
                $deleteUser->delete();
                $this->session->set("message", "User was successfully deleted");
                $this->di->get("response")->redirect("admin?tab=users");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [
            "user" => $user,
        ];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/user/delete", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminAddPost()
    {
        $this->init();
        $title      = "Admin - Add Post";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId && $userRole === 1) {
            if (!empty($_POST)) {
                $title = isset($_POST["title"]) ? htmlentities($_POST["title"]) : "";
                $content = isset($_POST["content"]) ? htmlentities($_POST["content"]) : "";
                $category = isset($_POST["category"]) ? htmlentities($_POST["category"]) : "";
                $image = isset($_POST["image"]) ? htmlentities($_POST["image"]) : "";

                if ($title && $content && $category) {
                    $response = $this->post->createPost($userId, $content, $title, $image, $category);
                } else if (!$response || !$title && !$content && !$category) {
                    $this->session->set("message", "Post couldn't be created");
                    $this->di->get("response")->redirect("admin?tab=posts");
                }

                $this->session->set("message", "Post was successfully added");
                $this->di->get("response")->redirect("admin?tab=posts");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [
            "images" =>$this->blogImages,
        ];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/post/new", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminEditPost($id)
    {
        $this->init();
        $title      = "Admin - Edit Post";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId && $userRole === 1) {
            $post = $this->post->find("id", $id);

            if (!empty($_POST)) {
                $title = isset($_POST["title"]) ? htmlentities($_POST["title"]) : "";
                $content = isset($_POST["content"]) ? htmlentities($_POST["content"]) : "";
                $category = isset($_POST["category"]) ? htmlentities($_POST["category"]) : "";
                $image = isset($_POST["image"]) ? htmlentities($_POST["image"]) : "";

                if ($title && $content && $category) {
                    $response = $this->post->updatePost($id, $userId, $content, $title, $image, $category);
                } else if (!$response || !$title && !$content && !$category) {
                    $this->session->set("message", "Post couldn't be updated");
                    $this->di->get("response")->redirect("admin?tab=posts");
                }
                
                $this->session->set("message", "Post was successfully updated");
                $this->di->get("response")->redirect("admin?tab=posts");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [
            "images" => $this->blogImages,
            "post" => $post,
        ];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/post/edit", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminDeletePost($id)
    {
        $this->init();
        $title      = "Admin - Delete Post";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId) {
            $post = $this->post->find("id", $id);

            if (!empty($_POST)) {
                $postId = isset($_POST["id"]) ? htmlentities($_POST["id"]) : "";
                $deletePost = $this->post->find("id", $postId);
                $deletePost->delete();
                $this->session->set("message", "Post was successfully deleted");
                $this->di->get("response")->redirect("admin?tab=posts");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [
            "post" => $post,
        ];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/post/delete", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminAddProduct()
    {
        $this->init();
        $title      = "Admin - Add Product";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId && $userRole === 1) {
            if (!empty($_POST)) {
                $name = isset($_POST["name"]) ? htmlentities($_POST["name"]) : "";
                $categories = isset($_POST["categories"]) ? $_POST["categories"] : "";
                $text = isset($_POST["text"]) ? htmlentities($_POST["text"]) : "";
                $description = isset($_POST["description"]) ? htmlentities($_POST["description"]) : "";
                $price = isset($_POST["price"]) ? htmlentities($_POST["price"]) : "";
                $oldPrice = isset($_POST["oldPrice"]) ? htmlentities($_POST["oldPrice"]) : "";
                $image = isset($_POST["image"]) ? htmlentities($_POST["image"]) : "";
                $stock = isset($_POST["stock"]) ? htmlentities($_POST["stock"]) : "";

                if ($name && $description && $categories) {
                    $response = $this->product->createProduct($userId, $name, $text, $description, $price, $image, $stock, $categories, $this->di);
                } else if (!$response || !$name && !$description && !$categories) {
                    $this->session->set("message", "Product couldn't be created");
                    $this->di->get("response")->redirect("admin?tab=products");
                }

                $this->session->set("message", "Product was successfully added");
                $this->di->get("response")->redirect("admin?tab=products");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [
            "images" => $this->shopImages,
            "categories" => $this->category->getCategories(10),
        ];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/product/new", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminEditProduct($id)
    {
        $this->init();
        $title      = "Admin - Edit Product";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId && $userRole === 1) {
            $product = $this->product->find("id", $id);
            $productImages = $this->categoryProduct->findCategoriesToProduct($id);

            if (!empty($_POST)) {
                $name = isset($_POST["name"]) ? htmlentities($_POST["name"]) : "";
                $categories = isset($_POST["categories"]) ? $_POST["categories"] : "";
                $text = isset($_POST["text"]) ? htmlentities($_POST["text"]) : "";
                $description = isset($_POST["description"]) ? htmlentities($_POST["description"]) : "";
                $price = isset($_POST["price"]) ? htmlentities($_POST["price"]) : "";
                $oldPrice = isset($_POST["oldPrice"]) ? htmlentities($_POST["oldPrice"]) : "";
                $image = isset($_POST["image"]) ? htmlentities($_POST["image"]) : "";
                $stock = isset($_POST["stock"]) ? htmlentities($_POST["stock"]) : "";

                if ($name && $description && $categories) {
                    // $response = $this->product->updateProduct($id, $userId, $name, $text, $description, $price, $image, $stock, $categories, $this->di);
                } else if (!$response || !$title && !$description && !$categories) {
                    $this->session->set("message", "Product couldn't be updated");
                    $this->di->get("response")->redirect("admin?tab=products");
                }

                $this->session->set("message", "Product was successfully updated");
                $this->di->get("response")->redirect("admin?tab=products");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [
            "images" => $this->shopImages,
            "product" => $product,
            "productImages" => $productImages,
            "categories" => $this->category->getCategories(10),
        ];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/product/edit", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminDeleteProduct($id)
    {
        $this->init();
        $title      = "Admin - Delete Product";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId) {
            $product = $this->product->find("id", $id);

            if (!empty($_POST)) {
                $productId = isset($_POST["id"]) ? htmlentities($_POST["id"]) : "";
                $deleteProduct = $this->post->find("id", $productId);
                $deleteProduct->delete();
                $this->session->set("message", "Product was successfully deleted");
                $this->di->get("response")->redirect("admin?tab=products");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [
            "product" => $product,
        ];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/product/delete", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminAddCategory()
    {
        $this->init();
        $title      = "Admin - Add Category";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId && $userRole === 1) {
            if (!empty($_POST)) {
                $category = isset($_POST["category"]) ? htmlentities($_POST["category"]) : "";

                if ($category) {
                    $response = $this->category->createCategory($category);
                } else if (!$response || !$category) {
                    $this->session->set("message", "Category couldn't be added");
                    $this->di->get("response")->redirect("admin?tab=categories");
                }

                $this->session->set("message", "Category was successfully added");
                $this->di->get("response")->redirect("admin?tab=categories");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/category/new", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminEditCategory($id)
    {
        $this->init();
        $title      = "Admin - Edit Category";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId && $userRole === 1) {
            $category = $this->category->find("id", $id);

            if (!empty($_POST)) {
                $categoryValue = isset($_POST["category"]) ? htmlentities($_POST["category"]) : "";

                if ($categoryValue) {
                    $response = $this->category->updateCategory($id, $categoryValue);
                } else if (!$response || !$categoryValue) {
                    $this->session->set("message", "Category couldn't be updated");
                    $this->di->get("response")->redirect("admin?tab=categories");
                }

                $this->session->set("message", "Category was successfully updated");
                $this->di->get("response")->redirect("admin?tab=categories");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [
            "category" => $category,
        ];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/category/edit", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    public function getAdminDeleteCategory($id)
    {
        $this->init();
        $title      = "Admin - Delete Category";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");
        $userRole = $this->session->get("userRole");

        if ($userId) {
            $category = $this->category->find("id", $id);

            if (!empty($_POST)) {
                $categoryId = isset($_POST["id"]) ? htmlentities($_POST["id"]) : "";
                $deleteCategory = $this->category->find("id", $categoryId);
                $deleteCategory->delete();
                $this->session->set("message", "Category was successfully deleted");
                $this->di->get("response")->redirect("admin?tab=categories");
            }
        } else {
            $this->di->get("response")->redirect("");
        }

        $data = [
            "category" => $category,
        ];

        $view->add("admin/partials/sidebar", [], "sidebar");
        $view->add("admin/category/delete", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
