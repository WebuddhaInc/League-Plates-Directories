<?php

namespace Webuddha\Plates\Template;

use Webuddha\Plates\Engine;
use Webuddha\Plates\Template\Name;

use LogicException;

/**
 * Container which holds template data and provides access to template functions.
 */
class Template extends \League\Plates\Template\Template
{

    /**
     * Create new Template instance.
     * @param Engine $engine
     * @param string $name
     */
    public function __construct(Engine $engine, $name)
    {
        parent::__construct($engine, $name);
        $this->engine = $engine;
        $this->name = new Name($engine, $name);
        $this->data($this->engine->getData($name));
    }

}