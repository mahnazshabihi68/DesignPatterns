<?php

class ReadFileAbstract
{
    protected $fileName;
    protected $contents;

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    public function getContents()
    {
        return $this->contents;
    }

    public function setContents($contents)
    {
        $this->contents = $contents;
    }
}

class ReadFileProxy extends ReadFileAbstract
{
    private $file;

    public function __construct($fileName)
    {
        $this->setFileName($fileName);
    }

    public function lazyLoad()
    {
        if($this->file === null) {
            $this->file = new ReadFile($this->getFileName());
        }

        return $this->file;
    }
}

class ReadFile extends ReadFileAbstract
{
    const DOCUMENT_PATH = __DIR__;

    public function __construct($fileName)
    {
        $this->setFileName($fileName);
        $this->contents = file_get_contents(self::DOCUMENT_PATH . "/" . $this->fileName);
    }
}

$fileOne = new ReadFileProxy('fileOne.txt');
$fileTow = new ReadFile('fileTow.txt');

$fileOne = $fileOne->lazyLoad();

echo $fileOne->getContents();