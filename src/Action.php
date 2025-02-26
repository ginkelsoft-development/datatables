<?php

namespace Ginkelsoft\DataTables;

/**
 * Class representing an action that can be performed on a DataTable row.
 */
class Action
{
    /** @var string The name of the action */
    public string $name;

    /** @var string The label displayed for the action */
    public string $label;

    /** @var string The route associated with the action */
    public string $route;

    /**
     * Action constructor.
     *
     * @param string $name  The action name
     * @param string $label The action label
     * @param string $route The route associated with the action
     */
    public function __construct(string $name, string $label, string $route)
    {
        $this->name = $name;
        $this->label = $label;
        $this->route = $route;
    }

    /**
     * Static method to create a new action instance.
     *
     * @param string $name  The action name
     * @param string $label The action label
     * @param string $route The route associated with the action
     * @return self A new Action instance
     */
    public static function make(string $name, string $label, string $route): self
    {
        return new self($name, $label, $route);
    }
}
