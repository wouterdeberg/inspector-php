<?php


namespace LogEngine\Models\Context;


abstract class AbstractContext implements \JsonSerializable
{
    public abstract function hasContent(): bool;

    public function __toString()
    {
        return json_encode($this->arrayFilterRecursive($this->jsonSerialize()));
    }

    protected function arrayFilterRecursive(array $payload)
    {
        foreach ($payload as $key => $item) {
            if (is_array($item)) {
                $payload[$key] = $this->arrayFilterRecursive($item);
            }

            if (empty ($payload [$key])) {
                unset ($payload [$key]);
            }
        }

        return $payload;
    }
}