<?php

namespace Scheb\Tombstone\Test;

use Scheb\Tombstone\Test\Fixtures\TraceFixture;
use Scheb\Tombstone\Tombstone;
use Scheb\Tombstone\Vampire;

class VampireTest extends TestCase
{
    /**
     * @test
     */
    public function createFromCall_dataGiven_returnCorrectlyConstructedVampire(): void
    {
        $stackTrace = TraceFixture::getTraceFixture();
        $vampire = Vampire::createFromCall('2015-08-19', 'author', 'label', $stackTrace);

        $this->assertInstanceOf(Vampire::class, $vampire);
        $this->assertInstanceOf(Tombstone::class, $vampire->getTombstone());
        $this->assertEquals('2015-08-19', $vampire->getTombstoneDate());
        $this->assertEquals('author', $vampire->getAuthor());
        $this->assertEquals('label', $vampire->getLabel());
        $this->assertEquals('/path/to/file1.php', $vampire->getFile());
        $this->assertEquals(11, $vampire->getLine());
        $this->assertEquals('containingMethodName', $vampire->getMethod());
        $this->assertEquals('invokerMethodName', $vampire->getInvoker());

        $invocationDate = strtotime($vampire->getInvocationDate());
        $this->assertEquals(time(), $invocationDate, '', 5);
    }
}
