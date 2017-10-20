<?php

namespace Wame\AdminModule\Commands;

use Wame\ComponentModule\Commands\CreatePositionCommand;


class PositionAdminBeforeContentCommand extends CreatePositionCommand
{
    /** {@inheritdoc} */
    protected function getPositionName()
    {
        return 'adminBeforeContent';
    }


    /** {@inheritdoc} */
    protected function getPositionTitle()
    {
        return _('Admin before content');
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
