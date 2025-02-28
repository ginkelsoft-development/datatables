<?php

namespace Ginkelsoft\DataTables;

class Action
{
    public string $name;
    public string $label;
    public ?string $route;
    public ?string $url;
    public array $attributes = [];

    /**
     * Action constructor.
     */
    public function __construct(string $name, string $label, ?string $route = null, ?string $url = null, array $attributes = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->route = $route;
        $this->url = $url;
        $this->attributes = $attributes;
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'label' => $this->label,
            'route' => $this->route,
            'url' => $this->url,
            'attributes' => $this->attributes
        ];
    }
}
