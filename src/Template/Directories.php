<?php

namespace Webuddha\Plates\Template;

use LogicException;

/**
 * Lookup template directories.
 */
class Directories
{

    /**
     * Template directory path.
     * @var string
     */
    protected $paths = array();

    /**
     * Create new Directories instance.
     * @param string $path
     */
    public function __construct($paths = null)
    {
        if( !empty($paths) ){
            $this->add($paths);
        }
    }

    /**
     * Add paths to lookup directories stack.
     * @param  string|array $path
     * @return Directories
     */
    public function add($path)
    {
        if( empty($path) || (!is_string($path) && !is_array($path)) ){
            throw new LogicException(
                'Invalid directories value.'
            );
        }
        if( is_string($path) ){
            if( !is_dir($path) ){
                throw new LogicException(
                    'The path '. $path .' does not exist.'
                );
            }
            $this->paths[] = $path;
        }
        else if( is_array($path) ){
            foreach( $path AS $_ ){
                $this->add( $_ );
            }
        }
        return $this;
    }

    /**
     * Remove from lookup directories array.
     * @param  string|array $path
     * @return Directories
     */
    public function remove($path)
    {
        if( empty($path) || (!is_string($path) && !is_array($path)) ){
            throw new LogicException(
                'Invalid directories value.'
            );
        }
        if( is_string($path) ){
            if( !isset($this->paths[ $path ]) ){
                throw new LogicException(
                    'The path '. $path .' is was not found.'
                );
            }
            unset( $this->paths[ $path ] );
        }
        else if( is_array($path) ){
            foreach( $path AS $_ ){
                $this->remove( $_ );
            }
        }
        return $this;
    }

    /**
     * Is path in lookup directories array.
     * @return boolean
     */
    public function exists($path)
    {
        return in_array( $path, $this->paths );
    }

    /**
     * Get lookup directories array.
     * @return array
     */
    public function get()
    {
        return $this->paths;
    }

}
