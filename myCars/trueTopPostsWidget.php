<?php

class trueTopPostsWidget extends WP_Widget{
    function __construct() {
        parent::__construct(
            'true_top_widget',
            'Вывод постов и их таксономий', // заголовок виджета
            array( 'description' => 'для вывода “Model”, “Cars” иерархии в виде “Accordion”' ) // описание
        );
    }

    /*
     * фронтэнд виджета
     */
    public function widget( $arg, $instance ) {
        wp_enqueue_script('myScript');
        $title = apply_filters( 'widget_title', $instance['title'] ); // к заголовку применяем фильтр (необязательно)
        echo $arg['before_widget'];
        if ( ! empty( $title ) ) {
            echo $arg['before_title'] . $title . $arg['after_title'];
        }
        $args = array(
            'taxonomy' => 'taxonomy',
            'hide_empty' => false,
            'orderby' => 'name',
            'order' => 'ASC',
        ); ?>
        <div id="accordion"><?php $custom_terms = get_terms($args);
            foreach ($custom_terms as $custom_term) {
                wp_reset_query();
                $loop = new WP_Query(array(
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'taxonomy',
                            'field' => 'name',
                            'terms' => $custom_term->name
                        )
                    )
                ));

                if ($loop->have_posts()) {
                    echo '<h3>' . $custom_term->name . '</h3>';
                    echo '<div>';
                    while ($loop->have_posts()) {
                        $loop->the_post();
                        echo '<p>' . get_the_title() . '</p>';
                    }
                    echo '</div>';
                }
            } ?>
        </div>
        <?php
        echo($arg['after_widget']);
    }

    /*
     * бэкэнд виджета
     */
    public function form($instance)
    {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        }
        if (isset($instance['posts_per_page'])) {
            $posts_per_page = $instance['posts_per_page'];
        }
    }

    /*
     * сохранение настроек виджета
     */
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['posts_per_page'] = ( is_numeric( $new_instance['posts_per_page'] ) ) ? $new_instance['posts_per_page'] : '5'; // по умолчанию выводятся 5 постов
        return $instance;
    }
}