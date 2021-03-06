<?php


interface WriterFactory
{
    public function createCsvWriter(): CsvWriter;
    public function createJsonWriter(): JsonWriter;
}

interface CsvWriter
{
    public function write(array $line): string;
}

interface JsonWriter
{
    public function write(array $data, bool $formatted): string;
}

class UnixCsvWriter implements CsvWriter
{
    public function write(array $line): string
    {
        return join(',', $line) . "\n";
    }
}


class UnixJsonWriter implements JsonWriter
{
    public function write(array $data, bool $formatted): string
    {
        $options = 0;

        if ($formatted) {
            $options = JSON_PRETTY_PRINT;
        }

        return json_encode($data, $options);
    }
}   

class UnixWriterFactory implements WriterFactory
{
    public function createCsvWriter(): CsvWriter
    {
        return new UnixCsvWriter();
    }

    public function createJsonWriter(): JsonWriter
    {
        return new UnixJsonWriter();
    }
}

class WinCsvWriter implements CsvWriter
{
    public function write(array $line): string
    {
        return join(',', $line) . "\r\n";
    }
}

class WinJsonWriter implements JsonWriter
{
    public function write(array $data, bool $formatted): string
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}

class WinWriterFactory implements WriterFactory
{
    public function createCsvWriter(): CsvWriter
    {
        return new WinCsvWriter();
    }

    public function createJsonWriter(): JsonWriter
    {
        return new WinJsonWriter();
    }
}


$unixWriterFactory = new UnixWriterFactory();
$obj = $unixWriterFactory->createCsvWriter();
echo $obj->write(['1' => 'item1', 2 => 'item2']) . '<br>';

$json_obj = $unixWriterFactory->createJsonWriter();
echo $json_obj->write(['1' => 'item1', 2 => 'item2'], 1);

