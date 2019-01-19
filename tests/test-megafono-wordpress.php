<?php
/**
 * Class Megafono
 *
 * @package Megafono
 */

/**
 * Sample test case.
 */
class MegafonoWordpressTest extends WP_UnitTestCase {
    function test_MegafonoSiteHeight() {
        $GLOBALS['content_width'] = 200;

        $this->assertEquals(array('width' => 200, 'height' => 300.0), wp_embed_defaults('mysite.com/test'));
        $this->assertEquals(array('width' => 200, 'height' => 190), wp_embed_defaults('megafono.host/e/'));

        $this->assertEquals(array('width' => 200, 'height' => 190), wp_embed_defaults("megafono.host/e/test-episode") );
        $this->assertEquals(array('width' => 200, 'height' => 190), wp_embed_defaults("megafono.host/podcast/channel/test-episode") );
        $this->assertEquals(array('width' => 200, 'height' => 190), wp_embed_defaults("megafono.host/podcast/test/e/123test-episode") );
        $this->assertEquals(array('width' => 200, 'height' => 190), wp_embed_defaults("megafono.host/e/?test-episode") );
        $this->assertEquals(array('width' => 200, 'height' => 190), wp_embed_defaults("megafono.host/?e/test-episode") );
        $this->assertEquals(array('width' => 200, 'height' => 190), wp_embed_defaults("megafono.host/e/test episode") );
    }
}
