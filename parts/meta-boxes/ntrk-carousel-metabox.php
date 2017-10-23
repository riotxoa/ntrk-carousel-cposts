<?php
/*
Title: NETIREKI Carousel Slides
Post Type: ntrk_carousel_cpost
*/

/* Display shortcode tag for current Carousel (only if it has been published) */
if ( 'publish' === get_post_status($post->ID) ) {
    $shortcode = '<pre style="margin:0;">[ntrk-carousel-cposts id=' . $post->ID . ']</pre>';
    piklist('field', array(
        'type' => 'html',
        'label' => 'Shortcode',
        'value' => $shortcode
    ));
}

/* Carousel options (values for basic Slick settings) */
piklist('field', array(
    'type' => 'group',
    'label' => __('Carousel Settings', 'ntrk_carousel_cposts'),
    'fields' => array(
        array(
            'type' => 'checkbox',
            'field' => 'infinite',
            'label' => __('Infinite loop', 'ntrk_carousel_cposts'),
            'value' => 1,
            'choices' => array(
              1 => __('Yes', 'ntrk_carousel_cposts'),
            ),
            'columns' => 3,
        ),
        array(
            'type' => 'checkbox',
            'field' => 'dots',
            'label' => __('Navigation dots', 'ntrk_carousel_cposts'),
            'value' => 1,
            'choices' => array(
              1 => __('Yes', 'ntrk_carousel_cposts'),
            ),
            'columns' => 3
        ),
        array(
            'type' => 'number',
            'field' => 'slides_to_show',
            'label' => __('Slides to show', 'ntrk_carousel_cposts'),
            'value' => 3,
            'columns' => 3
        ),
        array(
            'type' => 'number',
            'field' => 'slides_to_scroll',
            'label' => __('Slides to scroll', 'ntrk_carousel_cposts'),
            'value' => '1',
            'columns' => 3
        ),
    )
));

/* Responsive display (values for Slick settings) */
piklist('field', array(
    'type' => 'group',
    'field' => 'responsive_settings',
    'label' => __('Responsive Settings', 'ntrk_carousel_cposts'),
    'fields' => array(
        array(
            'type' => 'group',
            'field' => 'resp_option',
            'add_more' => true,
            'fields' => array(
                array(
                    'type' => 'number',
                    'field' => 'width',
                    'label' => __('Breakpoint (px)', 'ntrk_carousel_cposts'),
                    'columns' => 4,
                ),
                array(
                    'type' => 'number',
                    'field' => 'slides_to_show',
                    'label' => __('Slides to show', 'ntrk_carousel_cposts'),
                    'value' => 3,
                    'columns' => 4
                ),
                array(
                    'type' => 'number',
                    'field' => 'slides_to_scroll',
                    'label' => __('Slides to scroll', 'ntrk_carousel_cposts'),
                    'value' => '1',
                    'columns' => 4
                ),
            )
        )
    )
));

/* Carousel Slides */
piklist('field', array(
    'type' => 'group',
    'field' => 'slides',
    'label' => __('Slides', 'ntrk_carousel_cposts'),
    'add_more' => true,
    'fields' => array(
        array(
            'type' => 'file',
            'field' => 'image',
            'label' => __('Image', 'ntrk_carousel_cposts'),
            'options' => array(
                'button' => __('Add image', 'ntrk_carousel_cposts'),
                'modal_title' => __('Select image', 'ntrk_carousel_cposts'),
            ),
        ),
        array(
            'type' => 'textarea',
            'field' => 'text',
            'label' => __('Slide Text (HTML allowed)', 'ntrk_carousel_cposts'),
            'columns' => 12,
            'attributes' => array(
                'rows' => 5,
                'placeholder' => __('Insert text', 'ntrk_carousel_cposts'),
            )
        )
    ),
));

?>
