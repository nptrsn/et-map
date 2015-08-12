<?php
/**
 * Sanitize inputted data
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     1.0.0
 */

class WPEX_Sanitize_Data {

    /**
     * Parses data
     *
     * @access  public
     * @since   2.0.0
     */
    public function parse_data( $data, $type ) {
        $type = str_replace( '-', '_', $type );
        if ( method_exists( $this, $type ) ) {
            return $this->$type( $data );
        }
    }

    /**
     * Pixels
     *
     * @access  private
     * @since   2.0.0
     */
    private function px( $data ) {

        if ( 'none' == $data ) {
            return '0';
        } else {
            return floatval( $data ) . 'px';
        }

    }

    /**
     * Font Size
     *
     * @access  private
     * @since   2.0.0
     */
    private function font_size( $data ) {

        if ( strpos( $data, 'px' ) || strpos( $data, 'em' ) ) {
            $data = $data;
        } else {
            $data = intval( $data ) .'px';
        }

        if ( $data != '0px' && $data != '0em' ) {
            return $data;
        }

    }

    /**
     * Font Weight
     *
     * @access  private
     * @since   2.0.0
     */
    private function font_weight( $data ) {

        if ( 'normal' == $data ) {
            $data = '400';
        } elseif ( 'semibold' == $data ) {
            $data = '600';
        } elseif ( 'bold' == $data ) {
            $data = '700';
        } elseif ( 'bolder' == $data ) {
            $data = '900';
        }

        return $data;
        
    }

    /**
     * Hex Color
     *
     * @access  private
     * @since   2.0.0
     */
    private function hex_color( $data ) {

        if ( 'none' == $data ) {
            return 'transparent';
        } elseif ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $data ) ) {
            return $data;
        } else {
            return null;
        }

    }

    /**
     * Border Radius
     *
     * @access  private
     * @since   2.0.0
     */
    private function border_radius( $data ) {

        if ( 'none' == $data ) {
            return '0';
        } elseif ( strpos( $data, 'px' ) ) {
            return $data;
        } elseif ( strpos( $data, '%' ) ) {
            if ( '50%' == $data ) {
                return $data;
            } else {
                return str_replace( '%', 'px', $data );
            }
        } else {
            return intval( $data ) .'px';
        }

    }

    /**
     * Pixel or Percent
     *
     * @access  private
     * @since   2.0.0
     */
    private function px_pct( $data ) {

        if ( 'none' == $data || '0px' == $data ) {
            return '0';
        } elseif ( strpos( $data, '%' ) ) {
            return $data;
        } elseif ( $data = floatval( $data ) ) {
            return $data .'px';
        }

    }

    /**
     * Opacity
     *
     * @access  private
     * @since   2.0.0
     */
    private function opacity( $data ) {

        if ( ! is_numeric( $data ) ) {
            return;
        } elseif ( '1' > $data ) {
            return $data;
        } else {
            return;
        }

    }

    /**
     * Embed URL
     *
     * @access  private
     * @since   2.0.0
     */
    private function embed_url( $data ) {

        // First sanatize the URL
        $url = esc_url( $data );

        // Sanitize vimeo
        if ( $url && false !== strpos( $url, 'vimeo' ) ) {
            
            // Get the ID
            $video_id = str_replace( 'http://vimeo.com/', '', $url );
            if ( ! is_numeric( $video_id ) ) {
                $video_id = str_replace( 'https://vimeo.com/', '', $url );
            } elseif ( ! is_numeric( $video_id ) ) {
                $video_id = str_replace( 'http://www.vimeo.com/', '', $url );
            } elseif ( ! is_numeric( $video_id ) ) {
                $video_id = str_replace( 'https://www.vimeo.com/', '', $url );
            }

            // Return embed URL
            if ( is_numeric( $video_id ) ) {
                return esc_url( 'player.vimeo.com/video/'. $video_id );
            }

        }

        // Sanitize Youtube
        elseif ( $url && false !== strpos( $url, 'youtu' ) ) {
            $url_string = parse_url( $url, PHP_URL_QUERY );
            parse_str( $url_string, $args );
            if ( ! empty ( $args['v'] ) ) {
                return esc_url( 'youtube.com/embed/' . $args['v'] );
            }
        }

    }


} // End Class

// Helper function runs the WPEX_Sanitize_Data class
function wpex_sanitize_data( $data = '', $type = '' ) {
    if ( $data && $type ) {
        $class = new WPEX_Sanitize_Data();
        return $class->parse_data( $data, $type );
    }
}