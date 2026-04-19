<?php
namespace Kunnu\Dropbox;

use PHPUnit\Framework\TestCase;

class DropboxFileTest extends TestCase
{
    protected $stream;

    protected function setUp(): void
    {
        $this->stream = fopen(__FILE__, 'r');
    }

    protected function tearDown(): void
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }
    }

    public function testGetStreamOrFilePathReturnsStringWhenConstructedNormally()
    {
        $dropboxFile = new DropboxFile('/i/am/a/file');

        $result = $dropboxFile->getStreamOrFilePath();

        self::assertSame('/i/am/a/file', $result);
    }

    public function testGetStreamOrFilePathReturnsStringWhenConstructedWithStream()
    {
        $dropboxFile = DropboxFile::createByStream('/i/am/a/file', $this->stream);

        $result = $dropboxFile->getStreamOrFilePath();

        self::assertSame($dropboxFile->getStream(), $result);
    }
}
