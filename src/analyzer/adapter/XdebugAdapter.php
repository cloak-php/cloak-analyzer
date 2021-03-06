<?php

/**
 * This file is part of cloak.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace cloak\analyzer\adapter;

use cloak\analyzer\AnalyzeAdapter;


/**
 * Class XdebugAdapter
 * @package cloak\analyzer
 */
class XdebugAdapter implements AnalyzeAdapter
{

    public function __construct()
    {
        if (!extension_loaded('xdebug')) {
            throw new AdapterNotAvailableException('This adapter requires Xdebug');
        }

        if ($this->isSupportXdebugVersion() && $this->isXdebugCoverageEnabled()) {
            throw new AdapterNotAvailableException('xdebug.coverage_enable=On has to be set in php.ini');
        }
    }

    public function start()
    {
        xdebug_start_code_coverage(XDEBUG_CC_UNUSED | XDEBUG_CC_DEAD_CODE);
    }

    public function stop()
    {
        $result = xdebug_get_code_coverage();
        xdebug_stop_code_coverage();

        return $result;
    }

    /**
     * @return boolean
     */
    private function isSupportXdebugVersion()
    {
        return version_compare(phpversion('xdebug'), '2.2.0-dev', '>=');
    }

    /**
     * @return boolean
     */
    private function isXdebugCoverageEnabled()
    {
        return !ini_get('xdebug.coverage_enable');
    }

}
