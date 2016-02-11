<?php
/* Icinga Web 2 | (c) 2016 Icinga Development Team | GPLv2+ */

namespace Icinga\Data\Filter;

class FilterMatchCaseInsensitive extends FilterMatch
{
    public function __construct($column, $sign, $expression) {
        parent::__construct($column, $sign, $expression);
        $this->caseSensitive = false;
    }
}
