<?php

namespace blakit\rocketsms\responses;

use blakit\rocketsms\structures\Sender;
use blakit\rocketsms\structures\Template;

class TemplatesResponse
{
    /** @var Template[] */
    private $templates;

    /**
     * TemplatesResponse constructor.
     * @param array $response
     */
    public function __construct($response)
    {
        $this->templates = [];

        foreach ($response as $sender) {
            $item = new Template();

            $item->tpl_id = $sender['tpl_id'];
            $item->text = $sender['template_id'];

            $this->templates[] = $item;
        }
    }

    /**
     * @return Sender[]
     */
    public function getTemplates()
    {
        return $this->templates;
    }
}