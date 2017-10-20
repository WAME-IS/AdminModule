<?php

namespace Wame\AdminModule\Commands;

use Wame\ComponentModule\Commands\CreatePositionCommand;


class PositionAdminHeaderRightCommand extends CreatePositionCommand
{
    /** {@inheritdoc} */
    protected function getPositionName()
    {
        return 'adminHeaderRight';
    }


    /** {@inheritdoc} */
    protected function getPositionTitle()
    {
        return _('Admin header right');
    }


    /** {@inheritdoc} */
    protected function getPositionDescription()
    {
        return null;
    }


    /** {@inheritdoc} */
    protected function getPositionParameters()
    {
        return [
            'container' => [
                'tag' => 'ul',
                'class' => 'right hide-on-med-and-down'
            ]
        ];
    }


    /** {@inheritdoc} */
    protected function inList()
    {
        return false;
    }

}
