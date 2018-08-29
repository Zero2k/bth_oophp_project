<?php

namespace Vibe\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Vibe\User\HTMLForm\UserLoginForm;
use \Vibe\User\HTMLForm\CreateUserForm;
use \Vibe\Order\Order;

/**
 * A controller class.
 */
class UserController implements
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

        $this->order = new Order();
        $this->order->setDb($this->di->get("database"));

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
    public function getIndex()
    {
        $title      = "A index page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");

        $data = [
            "content" => "An index page",
        ];

        $view->add("default2/article", $data);

        $pageRender->renderPage(["title" => $title]);
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
    public function getPostLogin()
    {
        $title      = "A login page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new UserLoginForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("page/login", $data);

        $pageRender->renderPage(["title" => $title]);
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
    public function getPostCreateUser()
    {
        $title      = "A create user page";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $form       = new CreateUserForm($this->di);

        $form->check();

        $data = [
            "content" => $form->getHTML(),
        ];

        $view->add("page/sign-up", $data);

        $pageRender->renderPage(["title" => $title]);
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
    public function getProfile()
    {
        $this->init();
        $title      = "Profile";
        $view       = $this->di->get("view");
        $pageRender = $this->di->get("pageRender");
        $userId = $this->session->get("userId");

        if ($userId) {
            $tab = isset($_GET["tab"]) ? $_GET["tab"] : '';
            $orderId = isset($_GET["orderId"]) ? $_GET["orderId"] : '';

            switch ($tab) {
                case 'profile':
                    $data = [
                        "content" => $this->user->getUserInfo($userId, 180),
                    ];

                    $view->add("user/partials/profile", $data, "partial");
                    break;

                case 'orders':
                    $data = [
                        "content" => $this->order->getOrders($userId),
                    ];

                    $view->add("user/partials/orders", $data, "partial");
                    break;

                case 'view-order':
                    $data = [
                        "content" => $this->order->getOrder($orderId),
                        "user" => $this->user->getUserInfo($userId),
                        "total" => $this->order->getOrderTotal($orderId),
                    ];

                    $view->add("user/partials/viewOrder", $data, "partial");
                    break;

                case 'address':
                    $data = [
                        "content" => $this->user->find("id", $userId),
                    ];

                    if (!empty($_POST)) {
                        $country = isset($_POST["country"]) ? htmlentities($_POST["country"]) : "";
                        $city = isset($_POST["city"]) ? htmlentities($_POST["city"]) : "";
                        $address = isset($_POST["address"]) ? htmlentities($_POST["address"]) : "";

                        $this->user->country = mb_strtolower($country, 'UTF-8');
                        $this->user->city = mb_strtolower($city, 'UTF-8');
                        $this->user->address = mb_strtolower($address, 'UTF-8');

                        $this->user->save();
                        $this->di->get("response")->redirect("profile");
                    }

                    $view->add("user/partials/address", $data, "partial");
                    break;

                case 'settings':
                    $data = [
                        "content" => $this->user->find("id", $userId),
                    ];

                    if (!empty($_POST)) {
                        $username = isset($_POST["username"]) ? htmlentities($_POST["username"]) : "";
                        $email = isset($_POST["email"]) ? htmlentities($_POST["email"]) : "";
                        $password = isset($_POST["password"]) ? htmlentities($_POST["password"]) : "";
                        $confirmPassword = isset($_POST["confirm-password"]) ? htmlentities($_POST["confirm-password"]) : "";

                        if (!$password) {
                            $this->user->username = $username;
                            $this->user->email = $email;
                            $this->user->password = $this->user->password;
                        } else {
                            if ($password !== $confirmPassword) {
                                return false;
                            }

                            $this->user->username = $username;
                            $this->user->email = $email;
                            $this->user->password = $password;
                            $this->user->setPassword($password);
                        }

                        $this->user->save();
                        $this->di->get("response")->redirect("profile");
                    }

                    $view->add("user/partials/settings", $data, "partial");
                    break;
                
                default:
                    $data = [
                        "content" => $this->user->getUserInfo($userId, 180),
                    ];

                    $view->add("user/partials/profile", $data, "partial");
                    break;
            }
        } else {
            $this->di->get("response")->redirect("login");
        }

        $data = [
            "userRole" => $this->session->get("userRole"),
        ];

        $view->add("user/profile", $data);

        $pageRender->renderPage(["title" => $title]);
    }



    /**
     * Handler user logout.
     *
     * @return void
     */
    public function logoutUser()
    {
        $this->di->get('session')->destroy();
        $this->di->get("response")->redirect("");
    }
}
