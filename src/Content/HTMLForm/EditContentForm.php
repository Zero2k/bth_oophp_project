<?php

namespace Vibe\Content\HTMLForm;

use \Vibe\Content\Content;
use \Anax\HTMLForm\FormModel;
use \Anax\DI\DIInterface;

/**
 * Example of FormModel implementation.
 */
class EditContentForm extends FormModel
{
    /**
     * Constructor injects with DI container.
     *
     * @param Anax\DI\DIInterface $di a service container
     */
    public function __construct(DIInterface $di, $type)
    {
        parent::__construct($di);
        $content = $this->getItemDetails($type);

        $this->form->create(
            [
                "id" => __CLASS__,
            ],
            [
                "id" => [
                    "type"        => "hidden",
                    "value" => $content->id
                ],

                "type" => [
                    "type"        => "hidden",
                    "value" => $content->type
                ],

                "content" => [
                    "class" => "form-control-textarea",
                    "type" => "textarea",
                    "value" => $content->content
                    //"description" => "Here you can place a description.",
                    //"placeholder" => "Here is a placeholder",
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
     * Get details on item to load form with.
     *
     * @param integer $id get details on item with id.
     *
     * @return Content
     */
    public function getItemDetails($type)
    {
        $content = new Content();
        $content->setDb($this->di->get("database"));
        $content->find("type", $type);
        return $content;
    }



    /**
     * Callback for submit-button which should return true if it could
     * carry out its work and false if something failed.
     *
     * @return boolean true if okey, false if something went wrong.
     */
    public function callbackSubmit()
    {
        $content = new Content();
        $content->setDb($this->di->get("database"));

        $id = $this->form->value("id");
        $text = $this->form->value("content");
        $type = $this->form->value("type");

        // Check if text is empty
        if (!$text) {
            $this->form->rememberValues();
            $this->form->addOutput("Enter text.");
            return false;
        }

        $content->updateContent($id, $text, $type);
        $this->form->addOutput("Content was updated.");

        return true;
    }
}
