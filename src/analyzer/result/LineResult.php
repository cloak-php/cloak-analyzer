<?php

/**
 * This file is part of cloak.
 *
 * (c) Noritaka Horio <holy.shared.design@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace cloak\analyzer\result;

/**
 * Class LineResult
 * @package cloak\analyzer\result
 */
class LineResult
{

    const EXECUTED = 1;
    const UNUSED = -1;
    const DEAD = -2;

//    private $file = null;
    private $lineNumber = null;
    private $analyzeResult = null;

    public function __construct($lineNumber = 0, $analyzeResult = self::EXECUTED)
    {
        $this->lineNumber = $lineNumber;
        $this->analyzeResult = $analyzeResult;
    }

//    public function isFileAssociated()
  //  {
    //    return is_null($this->file) === false;
//    }

//    public function link(FileResult $file)
  //  {
    //    $this->file = $file;
//    }

//    public function unlink()
  //  {
    //    $this->file = null;
//    }

//    public function getFile()
  //  {
    //    return $this->file;
//    }

    public function getLineNumber()
    {
        return $this->lineNumber;
    }

    public function getAnalyzeResult()
    {
        return $this->analyzeResult;
    }

    public function isDead()
    {
        return $this->analyzeResult === self::DEAD;
    }

    public function isUnused()
    {
        return $this->analyzeResult === self::UNUSED;
    }

    public function isExecuted()
    {
        return $this->analyzeResult === self::EXECUTED;
    }

    public function isValid()
    {
        $analyzeResult = ($this->isDead() || $this->isExecuted() || $this->isUnused());
        return $this->getLineNumber() > 0 && $analyzeResult === true;
    }

    public function equals(LineResult $line)
    {
        return ($line->getLineNumber() === $this->getLineNumber() && $line->getAnalyzeResult() === $this->getAnalyzeResult());
    }

}
