<?php

namespace Vibe\User\HTMLForm;

use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;
use \Vibe\User\User;

/**
 * Form to update an item.
 */
class UpdateAddressForm extends FormModel
{
    /**
     * Constructor injects with DI container and the id to update.
     *
     * @param Anax\DI\DIInterface $di a service container
     * @param integer             $id to update
     */
    public function __construct(DIInterface $di, $id)
    {
        parent::__construct($di);
        $user = $this->getUserDetails($id);
        $this->form->create(
            [
                "id" => __CLASS__,
                /* "legend" => "Update details of the item", */
            ],
            [
                "id" => [
                    "type" => "hidden",
                    "validation" => ["not_empty"],
                    "readonly" => true,
                    "value" => $user->id,
                ],
                "country" => [
                    "class" => "form-control-custom",
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->country,
                ],
                "address" => [
                    "class" => "form-control-custom",
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->address,
                ],
                "city" => [
                    "class" => "form-control-custom",
                    "type" => "text",
                    "validation" => ["not_empty"],
                    "value" => $user->city,
                ],
                "submit" => [
                    "class" => "btn btn-primary btn-block btn-user",
                    "type" => "submit",
                    "value" => "Save",
                    "callback" => [$this, "callbackSubmit"]
                ],
            ]
        );
    }



    /**
     * Get details on user to load form with.
     *
     * @param integer $id get details on user with id.
     *
     * @return User
     */
    public function getUserDetails($id)
    {
        $user = new User();
        $user->setDb($this->di->get("database"));
        $user->find("id", $id);
        return $user;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $user = new User();
        $user->setDb($this->di->get("database"));
        $user->find("id", $this->form->value("id"));

        $country = $this->form->value("country");
        $address = $this->form->value("address");
        $city = $this->form->value("city");

        $user->username = $user->username;
        $user->email = $user->email;
        $user->password = $user->password;
        $user->country = mb_strtolower($country, 'UTF-8');
        $user->address = mb_strtolower($address, 'UTF-8');
        $user->city = mb_strtolower($city, 'UTF-8');
        $user->save();

        $this->di->get("response")->redirect("profile");
    }
}
