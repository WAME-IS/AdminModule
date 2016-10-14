<?php

namespace Wame\AdminModule\Vendor\Wame\DataGridControl\Actions;

use Wame\DataGridControl\BaseGridItem;
use Wame\DataGridControl\DataGridControl;

abstract class BaseGridAction extends BaseGridItem
{
    /** @var string */
    private $link;

    /** @var mixed */
    private $linkParams = null;

    /** @var array */
    private $attributes = [];


    /** set *******************************************************************/

    /**
     * Set link
     *
     * @param string $link link
     * @param mixed $params params
     * @return $this
     */
    protected function setLink($link, $params = null)
    {
        $this->link = $link;
        $this->linkParams = $params;

        return $this;
    }

    /**
     * Set attribute
     *
     * @param string $key key
     * @param mixed $val value
     * @return $this
     */
    protected function setAttribute($key, $val)
    {
        $this->attributes[$key] = $val;

        return $this;
    }


    /** get *******************************************************************/

    /**
     * Return link
     *
     * @param DataGridControl $grid
     * @return string
     */
    protected function getLink(DataGridControl $grid)
    {
        if ($this->link) {
            return $this->link;
        } else {
            return ":{$grid->presenter->getName()}:remove";
        }
    }

    /**
     * Get link params
     *
     * @return mixed
     */
    protected function getLinkParams()
    {
        return $this->linkParams;
    }

    /**
     * Get attributes
     *
     * @return array
     */
    protected function getAttributes()
    {
        return $this->attributes;
    }

}