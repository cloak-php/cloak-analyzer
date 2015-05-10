<?php

/**
 * This file is part of cloak.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace cloak\analyzer\adaptor;

use cloak\analyzer\AnalyzeAdaptor;


/**
 * Class HHVMAdaptor
 * @package cloak\analyzer\adaptor
 */
class HHVMAdaptor implements AnalyzeAdaptor
{

    public function __construct()
    {
        if (defined('HHVM_VERSION') === false) {
            throw new AdaptorNotAvailableException('This adaptor requires hhvm');
        }
    }

    public function start()
    {
        fb_enable_code_coverage();
    }

    public function stop()
    {
        $result = fb_get_code_coverage(true);
        fb_disable_code_coverage();

        return $result;
    }

}
