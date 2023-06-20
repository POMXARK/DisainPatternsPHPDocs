<?php

interface  NamingStrategy
{
    function createName($filename);
}

class ZipFileNamingStrategy implements NamingStrategy
{
    function createName($filename): string
    {
        return "http://downloads.foo.bar/{$filename}.zip";
    }
}

class TarGzFileNamingStrategy implements NamingStrategy
{
    function createName($filename): string
    {
        return "http://downloads.foo.bar/{$filename}.tar.gz";
    }
}

class Context
{
    private $namingStrategy;
    function __construct(NamingStrategy $strategy)
    {
        $this->namingStrategy = $strategy;
    }
    function execute(): array
    {
        $url[] = $this->namingStrategy->createName("Calc101");
        $url[] = $this->namingStrategy->createName("Stat2000");

        return $url;
    }
}


$context = new Context(new ZipFileNamingStrategy());
print_r($context->execute());

$context = new Context(new TarGzFileNamingStrategy());
print_r($context->execute());

