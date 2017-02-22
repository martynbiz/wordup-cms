<?php
/**
 * Will output a
 */

namespace App\Formatter;

abstract class AbstractFormatter
{
    /**
     * Name of formatter
     */
    protected static $name;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var array
     */
    protected $state;

    /**
     * @param Container $c
     * @param array $options
     * @param array $currentState e.g. [folder => $folder]
     */
    public function __construct($options, $state=[])
    {
        $this->options = $options;
        $this->state = $currentState;
    }

    /**
     * Get the name of the formatter
     * @return string
     */
    public static function getName()
    {
        return static::$name;
    }

    /**
     * Get the name of the formatter
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }
}
