<?php
/**
 * Created by PhpStorm.
 * User: planetoid
 * Date: 2018/1/23
 * Time: 下午5:21
 */

namespace Summer;

use PHPUnit\Framework\TestCase;
use Summer;

require_once __DIR__ . '/../WikiData.php';

class WikiDataTest extends TestCase
{
    protected function setUp(): void
    {
        $this->myClass = new Summer\WikiData();
        //echo __FUNCTION__ . ' called' . PHP_EOL;
    }
    protected function tearDown(): void
    {
        $this->myClass = null;
        //echo __FUNCTION__ . ' called' . PHP_EOL;
    }

    public function test_readFile()
    {
        $file_content = <<<EOT

Lzh-tw	Lzh-hant
磺溪流域	磺溪流域
小坑溪流域	小坑溪流域

EOT;

        $file_content = trim($file_content);


        $expected_result = <<<EOT

CREATE
LAST	Lzh-tw	"磺溪流域"
LAST	Lzh-hant	"磺溪流域"
CREATE
LAST	Lzh-tw	"小坑溪流域"
LAST	Lzh-hant	"小坑溪流域"

EOT;
        $expected_result = trim($expected_result);

        $file_content = trim($file_content);
        $actual_result = $this->myClass->readFile($file_content);
        $this->assertEquals($expected_result, $actual_result);



        $file_content = <<<EOT

Lzh-tw	P31
磺溪流域	Q166620
小坑溪流域	Q166620

EOT;

        $file_content = trim($file_content);


        $expected_result = <<<EOT

CREATE
LAST	Lzh-tw	"磺溪流域"
LAST	P31	Q166620
CREATE
LAST	Lzh-tw	"小坑溪流域"
LAST	P31	Q166620

EOT;
        $expected_result = trim($expected_result);

        $file_content = trim($file_content);
        $actual_result = $this->myClass->readFile($file_content);
        $this->assertEquals($expected_result, $actual_result);

    }
}
