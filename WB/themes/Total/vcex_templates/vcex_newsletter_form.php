<?php
/**
 * Output for the Newsletter Form Visual Composer module
 *
 * @package     Total
 * @subpackage  vcex_templates
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 2.0.0
 * @version     2.0.2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Not needed in admin ever.
if ( is_admin() ) return;

// Extract shortcode attributes
extract( shortcode_atts( array(
    'unique_id'             => '',
    'classes'               => '',
    'visibility'            => '',
    'css_animation'         => '',
    'provider'              => 'mailchimp',
    'mailchimp_form_action' => '',
    'input_width'           => '100%',
    'input_height'          => '50px',
    'input_border'          => '',
    'input_border_radius'   => '',
    'input_bg'              => '',
    'input_color'           => '',
    'input_padding'         => '',
    'input_font_size'       => '',
    'input_letter_spacing'  => '',
    'input_weight'          => '',
    'input_transform'       => '',
    'placeholder_text'      => __( 'Enter your email address', 'wpex' ),
    'submit_text'           => '',
    'submit_border'         => '',
    'submit_border_radius'  => '',
    'submit_bg'             => '',
    'submit_hover_bg'       => '',
    'submit_color'          => '',
    'submit_hover_color'    => '',
    'submit_padding'        => '',
    'submit_font_size'      => '',
    'submit_height'         => '',
    'submit_position_right' => '',
    'submit_letter_spacing' => '',
    'submit_weight'         => '',
    'submit_transform'      => '',
),
$atts ) );

// Vars
$input_style = $submit_style = $submit_data = '';

// Wrapper classes
$wrap_classes = 'vcex-newsletter-form clr';
if ( $classes ) {
    $wrap_classes .= $this->getExtraClass( $classes );
}
if ( $visibility ) {
    $wrap_classes .= ' '. $visibility;
}
if ( $css_animation ) {
    $wrap_classes .= $this->getCSSAnimation( $css_animation );
}

// Input Style
$input_style = vcex_inline_style( array(
    'border'            => $input_border,
    'border_radius'     => $input_border_radius,
    'padding'           => $input_padding,
    'letter_spacing'    => $input_letter_spacing,
    'height'            => $input_height,
    'background'        => $input_bg,
    'color'             => $input_color,
    'font_size'         => $input_font_size,
    'font_weight'       => $input_weight,
    'text_transform'    => $input_transform,
) );

// Submit Style
$submit_style = vcex_inline_style( array(
    'height'            => $submit_height,
    'line_height'       => $submit_height,
    'margin_top'        => '-'. $submit_height/2,
    'right'             => $submit_position_right,
    'border'            => $submit_border,
    'letter_spacing'    => $submit_letter_spacing,
    'padding'           => $submit_padding,
    'background'        => $submit_bg,
    'color'             => $submit_color,
    'font_size'         => $submit_font_size,
    'font_weight'       => $submit_weight,
    'text_transform'    => $submit_transform,
    'border_radius'     => $submit_border_radius,
) );

// Submit classes
$submit_classes = 'vcex-newsletter-form-button';

// Submit Data
if ( $submit_hover_bg ) {
    $submit_data .= ' data-hover-background="'. $submit_hover_bg .'"';
    $submit_classes .= ' wpex-data-hover';
}
if ( $submit_hover_color ) {
    $submit_data .= ' data-hover-color="'. $submit_hover_color .'"';
}

// Load inline js for data hover
if ( $submit_hover_bg || $submit_hover_color ) {
    vcex_inline_js( array( 'data_hover' ) );
}

// Mailchimp
if ( $provider == 'mailchimp' ) : ?>

    <div class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?>>

        <div id="mc_embed_signup" class="vcex-newsletter-form-wrap" style="width: <?php echo $input_width; ?>;">
            
            <form action="<?php echo $mailchimp_form_action; ?>" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                
                <input type="email" value="<?php echo $placeholder_text; ?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" name="EMAIL" class="required email" id="mce-EMAIL"<?php echo $input_style; ?>>

                <?php if ( $submit_text ) : ?>
                    <button type="submit" value="" name="subscribe" id="mc-embedded-subscribe" class="<?php echo $submit_classes; ?>"<?php echo $submit_style; ?><?php echo $submit_data; ?>>
                        <?php echo $submit_text; ?>
                    </button>
                <?php endif; ?>

            </form>

        </div><!--End mc_embed_signup-->

    </div><!-- .vcex-newsletter-form -->
    
<?php endif; ?>