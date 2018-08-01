<?php

namespace Vibe\Admin;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Vibe\User\User;
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
                        "content" => "categories",
                    ];

                    $view->add("admin/partials/categories", $data, "partial");
                    break;

                case 'products':
                    $data = [
                        "content" => "products",
                    ];

                    $view->add("admin/partials/products", $data, "partial");
                    break;

                case 'posts':
                    $data = [
                        "content" => "posts",
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
}
