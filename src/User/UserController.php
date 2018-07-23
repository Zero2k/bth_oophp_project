<?php

namespace Vibe\User;

use \Anax\Configure\ConfigureInterface;
use \Anax\Configure\ConfigureTrait;
use \Anax\DI\InjectionAwareInterface;
use \Anax\Di\InjectionAwareTrait;
use \Vibe\User\HTMLForm\UserLoginForm;
use \Vibe\User\HTMLForm\CreateUserForm;

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

            switch ($tab) {
                case 'profile':
                    $content = $this->user->getUserInfo($userId, 180);
                    break;

                case 'orders':
                    $content = "orders";
                    break;

                case 'address':
                    $content = "address";
                    break;

                case 'posts':
                    $content = "posts";
                    break;
                
                default:
                    $content = $this->user->getUserInfo($userId, 180);
                    break;
            }
        }

        $data = [
            "content" => $content,
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
