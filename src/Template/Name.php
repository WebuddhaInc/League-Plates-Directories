<?php

namespace Webuddha\Plates\Template;

use Webuddha\Plates\Engine;

use LogicException;

/**
 * A template name.
 */
class Name extends \League\Plates\Template\Name
{

    /**
     * Create a new Name instance.
     * @param Engine $engine
     * @param string $name
     */
    public function __construct(Engine $engine, $name)
    {
        parent::__construct($engine, $name);
        $this->setEngine($engine);
        $this->setName($name);
    }


    public function getPath()
    {

      $path = null;
      if( !empty($this->folder) ){
        $path = $this->folder->getPath() . DIRECTORY_SEPARATOR . $this->file;
        if( !is_file($path) && !$this->folder->getFallback() ){
          return null;
        }
      }

      $directories = $this->engine->getDirectories();
      if( !empty($directories) ){
        foreach( $directories AS $directory ){
          if( is_file($directory . DIRECTORY_SEPARATOR . $this->file) ){
            $path = $directory . DIRECTORY_SEPARATOR . $this->file;
            break;
          }
        }
      }

      return $path;
    }

}