<?php

declare(strict_types=1);

namespace zaporylie\Cargonizer\Data;

abstract class ObjectsWrapper implements \Iterator
{
    /**
     * Array of mixed objects.
     */
    protected array $array = [];

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->array);
    }

    /**
     * Remove item from array.
     */
    public function removeItem(string|int $delta): self
    {
        if (isset($this->array[$delta])) {
            unset($this->array[$delta]);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function rewind(): mixed
    {
        return reset($this->array);
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function current(): mixed
    {
        return current($this->array);
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function key(): mixed
    {
        return key($this->array);
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function next(): mixed
    {
        return next($this->array);
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function valid(): bool
    {
        return key($this->array) !== null;
    }
}
