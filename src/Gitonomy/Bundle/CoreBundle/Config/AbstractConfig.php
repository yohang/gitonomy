<?php

/**
 * This file is part of Gitonomy.
 *
 * (c) Alexandre Salomé <alexandre.salome@gmail.com>
 * (c) Julien DIDIER <genzo.wm@gmail.com>
 *
 * This source file is subject to the GPL license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Gitonomy\Bundle\CoreBundle\Config;

/**
 * @author Alexandre Salomé <alexandre.salome@gmail.com>
 */
abstract class AbstractConfig implements ConfigInterface
{
    private $values;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function get($key, $default = null)
    {
        $values = $this->all();
        if (!isset($values[$key])) {
            return $default;
        }

        return $values[$key];
    }

    public function set($key, $value)
    {
        return $this->save(array_merge($this->all(), array($key => $value)));
    }

    public function all()
    {
        if (null !== $this->values)
        {
            return $this->values;
        }

        $this->values = $this->readAll();

        return $this->values;
    }

    public function merge(array $values)
    {
        return $this->save(array_merge($this->all(), $values));
    }

    abstract protected function readAll();

    abstract protected function save(array $valus);
}
