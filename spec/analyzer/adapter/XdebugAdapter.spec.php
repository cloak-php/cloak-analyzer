<?php

/**
 * This file is part of cloak.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use cloak\analyzer\adapter\XdebugAdapter;


describe(XdebugAdapter::class, function() {
    describe('#stop', function() {
        beforeEach(function() {
            $this->adapter = new XdebugAdapter();
            $this->adapter->start();
            $this->results = $this->adapter->stop();
        });
        it('report of coverage is being collected', function() {
            expect($this->results)->toBeAn('array');
        });
    });
});
