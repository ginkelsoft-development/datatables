<?php

namespace Ginkelsoft\DataTables;

use Illuminate\Database\Eloquent\Builder;

/**
 * Class Search
 *
 * Handles search functionality for DataTables.
 */
class Search
{
    /**
     * @var string|null $searchTerm
     * Stores the current search term.
     */
    protected ?string $searchTerm = null;

    /**
     * Set the search term.
     *
     * @param string|null $search The search term to be applied.
     * @return self Returns the Search instance for method chaining.
     */
    public function setSearch(?string $search): self
    {
        $this->searchTerm = $search;
        return $this;
    }

    /**
     * Apply the search term to the given query.
     *
     * @param Builder $query The Eloquent query builder instance.
     * @param array<string> $columns The columns to search in.
     * @return Builder Returns the modified query with the search applied.
     */
    public function apply(Builder $query, array $columns): Builder
    {
        if (!empty($this->searchTerm)) {
            $query->where(function (Builder $q) use ($columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', "%{$this->searchTerm}%");
                }
            });
        }

        return $query;
    }
}
