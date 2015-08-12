<?php
/**
 * Add new params to Visual Composer modules
 *
 * @package     Total
 * @subpackage  Visual Composer
 * @author      Alexander Clarke
 * @copyright   Copyright (c) 2015, WPExplorer.com
 * @link        http://www.wpexplorer.com
 * @since       Total 1.0.0
 */

/*-----------------------------------------------------------------------------------*/
/*  - Seperator With Text
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_text_separator', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Element Type', 'wpex' ),
    'param_name'    => 'element_type',
    'value'         => array(
        'div'   => 'div',
        'h1'    => 'h1',
        'h2'    => 'h2',
        'h3'    => 'h3',
        'h4'    => 'h4',
        'h5'    => 'h5',
        'h6'    => 'h6',
    ),
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Style', 'wpex' ),
    'param_name'    => 'style',
    'value'         => array(
        __( 'Bottom Border', 'wpex' )               => 'one',
        __( 'Bottom Border With Color', 'wpex' )    => 'two',
        __( 'Line Through', 'wpex' )                => 'three',
        __( 'Double Line Through', 'wpex' )         => 'four',
        __( 'Dotted', 'wpex' )                      => 'five',
        __( 'Dashed', 'wpex' )                      => 'six',
        __( 'Top & Bottom Borders', 'wpex' )        => 'seven',
        __( 'Graphical', 'wpex' )                   => 'eight',
        __( 'Outlined', 'wpex' )                    => 'nine',
    ),
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Border Color', 'wpex' ),
    'param_name'    => 'border_color',
    'description'   => __( 'Select a custom color for your colored border under the title.', 'wpex' ),
    'dependency'    => Array(
        'element'   => 'style',
        'value'     => array( 'two' ),
    ),
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'textfield',
    'heading'       => __( 'Font Size', 'wpex' ),
    'param_name'    => 'font_size',
    'description'   => __( 'You can use "em" or "px" values, but you must define them.', 'wpex' ),
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Font Weight', 'wpex' ),
    'param_name'    => 'font_weight',
    'description'   => __( 'Note: Not all font families support every font weight.', 'wpex' ),
    'value'         => vcex_font_weights(),
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'textfield',
    'heading'       => __( 'Bottom Margin', 'wpex' ),
    'param_name'    => 'margin_bottom',
    'description'   => __( 'Please enter a px value.', 'wpex' ),
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Background Color', 'wpex' ),
    'param_name'    => 'span_background',
    'dependency'    => Array(
        'element'   => 'style',
        'value'     => array( 'three', 'four', 'five', 'six' ),
    )
) );

vc_add_param( 'vc_text_separator', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Font Color', 'wpex' ),
    'param_name'    => 'span_color',
) );

/*-----------------------------------------------------------------------------------*/
/*  - Columns
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Style', 'wpex' ),
    'param_name'    => 'style',
    'value'         => array(
        __( 'Default', 'wpex' )     => '',
        __( 'Bordered', 'wpex' )    => 'bordered',
        __( 'Boxed', 'wpex' )       => 'boxed',
    ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Visibility', 'wpex' ),
    'param_name'    => 'visibility',
    'std'           => '',
    'value'         => vcex_visibility(),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Animation', 'wpex' ),
    'param_name'    => 'css_animation',
    'value'         => vcex_css_animations(),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Typography Style', 'wpex' ),
    'param_name'    => 'typo_style',
    'value'         => array(
        __( 'Default', 'wpex' )     => '',
        __( 'White Text', 'wpex' )  => 'light',
    ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'checkbox',
    'heading'       => __( 'Drop Shadow?', 'wpex' ),
    'param_name'    => 'drop_shadow',
    'value'         => Array(
        __( 'Yes please.', 'wpex' ) => 'yes'
    ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Minimum Height', 'wpex' ),
    'param_name'    => 'min_height',
    'description'   => __( 'You can enter a minimum height for this row.', 'wpex' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Background Color', 'wpex' ),
    'param_name'    => 'bg_color',
    'group'         => __( 'Background', 'wpex' ),
) );


vc_add_param( 'vc_column', array(
    'type'          => 'attach_image',
    'heading'       => __( 'Background Image', 'wpex' ),
    'param_name'    => 'bg_image',
    'description'   => __( 'Select image from media library.', 'wpex' ),
    'group'         => __( 'Background', 'wpex' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Background Image Style', 'wpex' ),
    'param_name'    => 'bg_style',
    'value'         => array(
        __( 'Default', 'wpex' )     => '',
        __( 'Stretched', 'wpex' )   => 'stretch',
        __( 'Fixed', 'wpex' )       => 'fixed',
        __( 'Parallax', 'wpex' )    => 'parallax',
        __( 'Repeat', 'wpex' )      => 'repeat',
    ),
    'dependency' => Array(
        'element'   => 'background_image',
        'not_empty' => true
    ),
    'group'         => __( 'Background', 'wpex' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Border Style', 'wpex' ),
    'param_name'    => 'border_style',
    'value'         => vcex_border_styles(),
    'group'         => __( 'Border', 'wpex' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Border Color', 'wpex' ),
    'param_name'    => 'border_color',
    'group'         => __( 'Border', 'wpex' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Border Width', 'wpex' ),
    'param_name'    => 'border_width',
    'description'   => __( 'Please use the following format: top right bottom left.', 'wpex' ),
    'group'         => __( 'Border', 'wpex' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Margin Top', 'wpex' ),
    'param_name'    => 'margin_top',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Margin Bottom', 'wpex' ),
    'param_name'    => 'margin_bottom',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Top', 'wpex' ),
    'param_name'    => 'padding_top',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Bottom', 'wpex' ),
    'param_name'    => 'padding_bottom',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Left', 'wpex' ),
    'param_name'    => 'padding_left',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );

vc_add_param( 'vc_column', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Right', 'wpex' ),
    'param_name'    => 'padding_right',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );

/*-----------------------------------------------------------------------------------*/
/*  - Inner Columns
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Style', 'wpex' ),
    'param_name'    => 'style',
    'value'         => array(
        __( 'Default', 'wpex' )     => 'default',
        __( 'Bordered', 'wpex' )    => 'bordered',
        __( 'Boxed', 'wpex' )       => 'boxed',
    ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Visibility', 'wpex' ),
    'param_name'    => 'visibility',
    'value'         => vcex_visibility(),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Animation', 'wpex' ),
    'param_name'    => 'css_animation',
    'value'         => vcex_css_animations(),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Typography Style', 'wpex' ),
    'param_name'    => 'typo_style',
    'value'         => array(
        __( 'Dark Text', 'wpex' )   => '',
        __( 'White Text', 'wpex' )  => 'light',
    ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'checkbox',
    'heading'       => __( 'Drop Shadow?', 'wpex' ),
    'param_name'    => 'drop_shadow',
    'value'         => Array(
        __( 'Yes please.', 'wpex' ) => 'yes'
    ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Background Color', 'wpex' ),
    'param_name'    => 'bg_color',
    'group'         => __( 'Background', 'wpex' ),
) );


vc_add_param( 'vc_column_inner', array(
    'type'          => 'attach_image',
    'heading'       => __( 'Background Image', 'wpex' ),
    'param_name'    => 'bg_image',
    'description'   => __( 'Select image from media library.', 'wpex' ),
    'group'         => __( 'Background', 'wpex' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Background Image Style', 'wpex' ),
    'param_name'    => 'bg_style',
    'value'         => array(
        __( 'Stretched', 'wpex' )   => 'stretch',
        __( 'Fixed', 'wpex' )       => 'fixed',
        __( 'Parallax', 'wpex' )    => 'parallax',
        __( 'Repeat', 'wpex' )      => 'repeat',
    ),
    'dependency'    => Array(
        'element'   => 'background_image',
        'not_empty' => true
    ),
    'group'         => __( 'Background', 'wpex' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Border Style', 'wpex' ),
    'param_name'    => 'border_style',
    'value'         => vcex_border_styles(),
    'group'         => __( 'Border', 'wpex' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'colorpicker',
    'heading'       => __( 'Border Color', 'wpex' ),
    'param_name'    => 'border_color',
    'value'         => '',
    'group'         => __( 'Border', 'wpex' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Border Width', 'wpex' ),
    'param_name'    => 'border_width',
    'description'   => __( 'Please use the following format: top right bottom left.', 'wpex' ),
    'group'         => __( 'Border', 'wpex' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Margin Top', 'wpex' ),
    'param_name'    => 'margin_top',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Margin Bottom', 'wpex' ),
    'param_name'    => 'margin_bottom',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Top', 'wpex' ),
    'param_name'    => 'padding_top',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Bottom', 'wpex' ),
    'param_name'    => 'padding_bottom',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Left', 'wpex' ),
    'param_name'    => 'padding_left',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );

vc_add_param( 'vc_column_inner', array(
    'type'          => 'textfield',
    'heading'       => __( 'Padding Right', 'wpex' ),
    'param_name'    => 'padding_right',
    'group'         => __( 'Margin & Padding', 'wpex' ),
) );


/*-----------------------------------------------------------------------------------*/
/*  - Tabs
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_tabs', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Style', 'wpex' ),
    'param_name'    => 'style',
    'value'         => array(
        __( 'Default', 'wpex' )         => 'default',
        __( 'Alternative #1', 'wpex' )  => 'alternative-one',
        __( 'Alternative #2', 'wpex' )  => 'alternative-two',
    ),  
) );

/*-----------------------------------------------------------------------------------*/
/*  - Tours
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_tour', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Style', 'wpex' ),
    'param_name'    => 'style',
    'value'         => array(
        __( 'Default', 'wpex' )         => 'default',
        __( 'Alternative #1', 'wpex' )  => 'alternative-one',
        __( 'Alternative #2', 'wpex' )  => 'alternative-two',
    ),
    
) );

/*-----------------------------------------------------------------------------------*/
/*  - Custom Heading
/*-----------------------------------------------------------------------------------*/
vc_add_param( 'vc_custom_heading', array(
    'type'          => 'dropdown',
    'heading'       => __( 'Enqueue Font Style', 'wpex' ),
    'param_name'    => 'enqueue_font_style',
    'value'         => array(
        __( 'Yes', 'wpex' ) => '',
        __( 'No', 'wpex' )  => 'false',
    ),
    'descriptipn'   => __( 'If the Google Font you are using is already in use by the theme select No to prevent this font from loading again on the site.', 'wpex' ),
) );