<?php

/**
 * This file is part of cloak.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */


use Prophecy\Prophet;
use cloak\analyzer\Analyzer;
use cloak\analyzer\AnalyzeAdapter;
use cloak\analyzer\AnalyzedResult;


describe(Analyzer::class, function() {

    describe('#isStarted', function() {
        context('when after instantiation', function() {
            beforeEach(function() {
                $this->prophet = new Prophet();

                $adapter = $this->prophet->prophesize(AnalyzeAdapter::class);
                $adapter->start()->shouldNotBeCalled();
                $adapter->stop()->shouldNotBeCalled();

                $this->dirver = new Analyzer($adapter->reveal());
            });
            it('return false', function() {
                expect($this->dirver->isStarted())->toBeFalse();
            });
        });
        context('when started', function() {
            beforeEach(function() {
                $this->prophet = new Prophet();

                $adapter = $this->prophet->prophesize(AnalyzeAdapter::class);
                $adapter->start()->shouldBeCalled();
                $adapter->stop()->shouldNotBeCalled();

                $this->dirver = new Analyzer($adapter->reveal());
            });
            it('return true', function() {
                $this->dirver->start();
                expect($this->dirver->isStarted())->toBeTrue();
            });
        });
        context('when stoped', function() {
            beforeEach(function() {
                $this->prophet = new Prophet();

                $adapter = $this->prophet->prophesize(AnalyzeAdapter::class);
                $adapter->start()->shouldBeCalled();
                $adapter->stop()->shouldBeCalled();

                $this->dirver = new Analyzer($adapter->reveal());
            });
            it('return true', function() {
                $this->dirver->start();
                $this->dirver->stop();
                expect($this->dirver->isStarted())->toBeFalse();
            });
        });
    });

    describe('#getAnalyzeResult', function() {
        context('when after instantiation', function() {
            beforeEach(function() {
                $this->prophet = new Prophet();

                $adapter = $this->prophet->prophesize(AnalyzeAdapter::class);
                $adapter->start()->shouldNotBeCalled();
                $adapter->stop()->shouldNotBeCalled();

                $this->driver = new Analyzer($adapter->reveal());
            });
            it('return cloak\driver\Result', function() {
                $result = $this->driver->getAnalyzeResult();
                expect($result)->toBeAnInstanceOf(AnalyzedResult::class);
            });
        });
    });

});
