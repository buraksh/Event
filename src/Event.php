<?php
namespace Burax;

/**
 * Event class
 *
 * Very simple event dispatcher class
 *
 * @copyright Burak SAHIN 2015
 * @license The MIT License (see LICENCE.txt)
 * @author Burak SAHIN <buraksh@gmail.com>
 */
class Event {

    /**
     * @var array Registered event list
     */
    protected static $events = [];

    /**
     * Register an event handler
     *
     * @param string $name Event name
     * @param callable $callback Callback to be run
     * @param int $priority 
     * @throws \Exception
     */
    public static function on($name, callable $callback, $priority = 100)
    {
        if (!is_callable($callback)) {
            throw new EventDispatcherException("Handler $callback is not callable for $name event.");
        }

        if (isset(static::$events[$name][$priority])) {
            $priority++;
        }

        static::$events[$name][$priority][] = $callback;
    }

    /**
     * Trigger an event
     *
     * @param string $name Event name
     * @param array $params Parameters for callback functions
     * @return bool
     */
    public static function trigger($name, array $params = [])
    {

        if (isset(static::$events[$name])) {

            // sort callback function by priority
            $events = static::$events[$name];
            ksort($events);

            foreach ($events as $callbacks) {

                foreach ($callbacks as $callback) {
                    $result = call_user_func_array($callback, $params);

                    // Stop the propagation
                    if ($result === false) {
                        return false;
                    }

                }

            }

        }

        return true;

    }

}

/**
 * Class EventDispatcherException
 */
class EventDispatcherException extends \Exception{}