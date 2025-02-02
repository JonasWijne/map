<?php

namespace Regnerisch\Map;

use Regnerisch\Map\Interfaces\MapInterface;

abstract class Map extends ArrayAbstract implements MapInterface
{
    public function toArray(): array
    {
        return $this->map;
    }

    protected function setEach(array $map): void
    {
        $this->map = [];
        $this->addEach($map);
    }

    protected function addEach(array $map): void
    {
        $type = $this->getType();

        foreach ($map as $item) {
            $itemType = is_object($item) ? get_class($item) : gettype($item);
            if (null === $type || $itemType === $type) {
                $this->map[] = $item;
            } else {
                throw new \InvalidArgumentException(sprintf('Invalid type! Got %s expected %s', $itemType, $type));
            }
        }
    }

    abstract protected function getType(): ?string;
}
