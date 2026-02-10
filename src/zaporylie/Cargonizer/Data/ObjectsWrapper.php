<?php

namespace zaporylie\Cargonizer\Data;

abstract class ObjectsWrapper implements \Iterator
{

  /**
   * Array of mixed objects.
   *
   * @var array
   */
  protected array $array = [];

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return new \ArrayIterator($this->array);
  }

  /**
   * Remove item from array.
   *
   * @param string|int $delta
   *
   * @return self
   */
  public function removeItem(string|int $delta): self {
    if (isset($this->array[$delta])) {
      unset($this->array[$delta]);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function rewind(): mixed {
    return reset($this->array);
  }

  /**
   * {@inheritdoc}
   */
  public function current(): mixed {
    return current($this->array);
  }

  /**
   * {@inheritdoc}
   */
  public function key(): mixed {
    return key($this->array);
  }

  /**
   * {@inheritdoc}
   */
  public function next(): mixed {
    return next($this->array);
  }

  /**
   * {@inheritdoc}
   */
  public function valid(): bool {
    return key($this->array) !== null;
  }

}
