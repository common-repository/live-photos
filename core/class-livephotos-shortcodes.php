<?php
/**
 * class-livephotos-shortcodes.php
 *
 * Copyright (c) Antonio Blanco http://www.eggemplo.com
 *
 * This code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This header and all notices must be kept intact.
 *
 * @author Antonio Blanco (eggemplo)
 * @package livephotos
 * @since livephotos 0.1
 */

/**
 * LivePhotos_Shortcodes class
 */
class LivePhotos_Shortcodes {

	public static function init() {
		add_shortcode( 'livephotos_photo', array( __CLASS__, 'livephotos_photo' ) );
	}

	public static function livephotos_photo ( $atts, $content = null ) {
		$options = shortcode_atts(
				array(
						'img_src'   => '',
						'video_src' => '',
						'class'     => 'livephotos_photo'
				),
				$atts
		);
		extract( $options );

		$output = sprintf( '<div data-live-photo data-photo-src="%s" data-video-src="%s" class="%s" ></div>', $img_src, $video_src, $class );
		
		return $output;
	}

}
LivePhotos_Shortcodes::init();
