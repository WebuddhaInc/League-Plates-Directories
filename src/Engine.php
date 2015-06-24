<?php

namespace Webuddha\Plates;

use Webuddha\Plates\Template\Name;
use Webuddha\Plates\Template\Template;
use Webuddha\Plates\Template\Directories;

/**
 * Template API and environment settings storage.
 */
class Engine extends \League\Plates\Engine {

    /**
     * Lookup template directories.
     * @var Directories
     */
    protected $directories;

    /**
     * Create new Engine instance.
     * @param string $directory
     * @param string $fileExtension
     */
    public function __construct($directory = null, $fileExtension = 'php')
    {
        parent::__construct($directory, $fileExtension);
        $this->directories = new Directories($directory);
    }

    /**
     * [addDirectory description]
     * @param [type] $path [description]
     */
    public function addDirectory( $path ){
      $this->directories->add( $path );
      return $this;
    }

    /**
     * [getDirectories description]
     * @return [type] [description]
     */
    public function getDirectories(){
      return $this->directories->get();
    }

    /**
     * [removeDirectory description]
     * @param  [type] $path [description]
     * @return [type]       [description]
     */
    public function removeDirectory( $path ){
      $this->directories->remove( $path );
      return $this;
    }

    /**
     * Create a new template.
     * @param  string   $name
     * @return Template
     */
    public function make($name)
    {
        return new Template($this, $name);
    }

}