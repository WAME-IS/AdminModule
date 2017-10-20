<?php

namespace Wame\AdminModule\Commands;

use Wame\ComponentModule\Commands\CreatePositionCommand;


class PositionAdminAfterContentCommand extends CreatePositionCommand
{
    /** {@inheritdoc} */
    protected function getPositionName()
    {
        return 'adminAfterContent';
    }


    /** {@inheritdoc} */
    protected function getPositionTitle()
    {
        return _('Admin after content');
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
                'tag' => ''
            ]
        ];
    }


    /** {@inheritdoc} */
    protected function inList()
    {
        return false;
    }

}
