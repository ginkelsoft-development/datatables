<?php

namespace Ginkelsoft\DataTables;

class Action
{
    public string $name;
    public string $label;
    public string $route;
    public array $attributes = [];

    /**
     * Action constructor.
     *
     * @param string $name Unique action name.
     * @param string $label Button label.
     * @param string $route Named route for the action.
     * @param array $attributes Additional HTML attributes (e.g., classes, styles).
     */
    public function __construct(string $name, string $label, string $route, array $attributes = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->route = $route;
        $this->attributes = $attributes;
    }

    /**
     * Factory method to create an action instance.
     *
     * @param string $name Unique action name.
     * @param string $label Button label.
     * @param string $route Named route for the action.
     * @param array $attributes Additional HTML attributes (e.g., classes, styles).
     * @return self
     */
    public static function make(string $name, string $label, string $route, array $attributes = []): self
    {
        return new self($name, $label, $route, $attributes);
    }
}
