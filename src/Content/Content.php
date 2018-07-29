<?php

namespace Vibe\Content;

use \Anax\DI\DIInterface;
use \Anax\Database\ActiveRecordModel;
use \Anax\TextFilter\TextFilter;

/**
 * A database driven model.
 */
class Content extends ActiveRecordModel
{
    /**
     * @var string $tableName name of the database table.
     */
    protected $tableName = "Content";

    /**
     * Columns in the table.
     *
     * @var integer $id primary key auto incremented.
     */
    public $id;
    public $content;
    public $html;
    public $type;
    public $created;
    public $updated;



    /**
     * Create content
     *
     * @param string $content.
     * @param string $type.
     *
     * @return this
     */
    public function createContent($content, $type)
    {
        $this->content = $content;
        $this->html = $this->parseContent($content);
        $this->type = $type;
        $this->save();
        return $this;
    }



    /**
     * Update content
     *
     * @param integer $id.
     * @param string $content.
     * @param string $type.
     *
     */
    public function updateContent($contentId, $content, $type)
    {
        $this->find("id", $contentId);

        $this->id = $this->id;
        $this->content = $content;
        $this->html = $this->parseContent($content);
        $this->type = $type;
        $this->update();
    }



    public function parseContent($content)
    {
        $textfilter = new TextFilter();
        return $textfilter->parse($content, ["markdown", "clickable"])->text;
    }
}
