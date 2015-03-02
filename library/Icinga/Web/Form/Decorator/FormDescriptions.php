<?php
/* Icinga Web 2 | (c) 2013-2015 Icinga Development Team | GPLv2+ */

namespace Icinga\Web\Form\Decorator;

use Zend_Form_Decorator_Abstract;
use Icinga\Web\Form;

/**
 * Decorator to add a list of descriptions at the top of a form
 */
class FormDescriptions extends Zend_Form_Decorator_Abstract
{
    /**
     * Render form descriptions
     *
     * @param   string      $content    The html rendered so far
     *
     * @return  string                  The updated html
     */
    public function render($content = '')
    {
        $form = $this->getElement();
        if (! $form instanceof Form) {
            return $content;
        }

        $view = $form->getView();
        if ($view === null) {
            return $content;
        }

        $descriptions = $form->getDescriptions();
        if (empty($descriptions)) {
            return $content;
        }

        $html = '<ul class="descriptions">';
        foreach ($descriptions as $description) {
            if (is_array($description)) {
                list($description, $properties) = $description;
                $html .= '<li' . $view->propertiesToString($properties) . '>' . $view->escape($description) . '</li>';
            } else {
                $html .= '<li>' . $view->escape($description) . '</li>';
            }
        }

        switch ($this->getPlacement()) {
            case self::APPEND:
                return $content . $html . '</ul>';
            case self::PREPEND:
                return $html . '</ul>' . $content;
        }
    }
}