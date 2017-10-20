<?php

namespace Wame\AdminModule\Commands;

use Wame\ComponentModule\Commands\CreatePositionCommand;


class PositionAdminHeaderLeftCommand extends CreatePositionCommand
{
    /** {@inheritdoc} */
    protected function getPositionName()
    {
        return 'adminHeaderLeft';
    }


    /** {@inheritdoc} */
    protected function getPositionTitle()
    {
        return _('Admin header left');
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
                'class' => 'left hide-on-med-and-down'
            ]
        ];
    }


    /** {@inheritdoc} */
    protected function inList()
    {
        return false;
    }

}
