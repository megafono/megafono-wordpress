<?php
/**
 * Class Megafono
 *
 * @package Megafono
 */

/**
 * Sample test case.
 */
class MegafonoTest extends WP_UnitTestCase {
    function test_is_megafono_url() {
        $megafono = new Megafono();
        $this->assertTrue($megafono->is_megafono_url("megafono.host/e/test-episode") );
        $this->assertTrue($megafono->is_megafono_url("megafono.host/podcast/test/e/test-episode") );
        $this->assertTrue($megafono->is_megafono_url("megafono.host/podcast/test/e/123test-episode") );
        $this->assertFalse($megafono->is_megafono_url("megafono.host/e/?test-episode") );
        $this->assertFalse($megafono->is_megafono_url("megafono.host/?e/test-episode") );
        $this->assertFalse($megafono->is_megafono_url("megafono.host/e/test episode") );
    }
}
