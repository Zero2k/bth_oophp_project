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
            "userRole" => $this->session->get("userRole"),
        ];

        $view->add("admin/dashboard", $data);

        $pageRender->renderPage(["title" => $title]);
    }
}
