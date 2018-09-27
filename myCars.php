<?php
/*
Plugin Name: My Cars
Description: 1) Создать кастомный пост тайп “Cars”; 2) Создать таксономию “Model” для пост тайпа “Cars”; 3) Разработать Widget для вывода “Model”, “Cars” иерархии в виде “Accordion”
Version: 1.0
*/

class MyCars
{
	public function __construct() {

		$language_locale = ( get_locale() != '' ) ? get_locale() : 'en_US';
		$language_file = WP_LANG_DIR . '/plugins/my-cars-' . $language_locale . '.mo';
		load_textdomain( 'my-cars', $language_file );

		add_action ('wp_enqueue_scripts', array($this, 'register_script'));
		add_action ('init', array($this, 'regist_post'));
		add_action ('init', array($this, 'create_taxonomy'));
		require_once ('trueTopPostsWidget.php');  //add Class
		add_action ('widgets_init', array($this, 'register_widget'));
		add_shortcode ('add_car_form', array($this, 'register_car_form_shortcode'));
		add_shortcode ('cars_list', array($this, 'register_list_car_shortcode'));
	}

	public function register_script () {
		wp_register_style('jquery-ui', plugins_url() . '/myCars/assets/js/jqueryui/jquery-ui.css' );
		wp_register_script ('myScript', plugins_url() . '/myCars/assets/js/script.js', array('jquery', 'jquery-ui-accordion'), '1.0', true);
	}

	public function regist_post ()
	{
		register_post_type ('post_type_name', array(
			'label' => null,
			'labels' => array(
				'name' => __('MyCars'), // основное название для типа записи
				'singular_name' => __('Car', 'my-cars'), // название для одной записи этого типа
				'add_new' => __('Add Car', 'my-cars'), // для добавления новой записи
				'add_new_item' => __('Add car'), // заголовка у вновь создаваемой записи в админ-панели.
				'edit_item' => __('Edit car'), // для редактирования типа записи
				'new_item' => __('Новое ____'), // текст новой записи
				'view_item' => __('View item'), // для просмотра записи этого типа.
				'search_items' => __('Искать ____'), // для поиска по этим типам записи
				'not_found' => __('Не найдено'), // если в результате поиска ничего не было найдено
				'not_found_in_trash' => __('Не найдено в корзине'), // если не было найдено в корзине
				'parent_item_colon' => '', // для родителей (у древовидных типов)
				'menu_name' => __('Cars'), // название меню
			),
			'description' => '',
			'public' => true,
			'publicly_queryable' => null, // зависит от public
			'exclude_from_search' => null, // зависит от public
			'show_ui' => null, // зависит от public
			'show_in_menu' => null, // показывать ли в меню адмнки
			'show_in_admin_bar' => null, // по умолчанию значение show_in_menu
			'show_in_nav_menus' => null, // зависит от public
			'show_in_rest' => null, // добавить в REST API. C WP 4.7
			'rest_base' => null, // $post_type. C WP 4.7
			'menu_position' => null,
			'menu_icon' => null,
			//'capability_type'   => 'post',
			//'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
			//'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
			'hierarchical' => false,
			'supports' => array('title', 'editor'), // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
			'taxonomies' => array('taxonomy'),
			'has_archive' => false,
			'rewrite' => true,
			'query_var' => true,
		));
	}

	public function create_taxonomy ()
	{
		register_taxonomy ('taxonomy', array('post_type_name'), array(
			'label' => '', // определяется параметром $labels->name
			'labels' => array(
				'name' => __('Models'),
				'singular_name' => __('Model'),
				'search_items' => __('Search Model'),
				'all_items' => __('All Models'),
				'view_item ' => __('View Model'),
				'parent_item' => __('Parent Model'),
				'parent_item_colon' => __('Parent Genre:'),
				'edit_item' => __('Edit Genre'),
				'update_item' => __('Update Genre'),
				'add_new_item' => __('Add New Model'),
				'new_item_name' => __('New Model Name'),
				'menu_name' => __('Model'),
			),
			'description' => '', // описание таксономии
			'public' => true,
			'publicly_queryable' => null, // равен аргументу public
			'show_in_nav_menus' => true, // равен аргументу public
			'show_ui' => true, // равен аргументу public
			'show_in_menu' => true, // равен аргументу show_ui
			'show_tagcloud' => true, // равен аргументу show_ui
			'show_in_rest' => null, // добавить в REST API
			'rest_base' => null, // $taxonomy
			'hierarchical' => false,
			'update_count_callback' => '',
			'rewrite' => true,
			//'query_var'             => $taxonomy, // название параметра запроса
			'capabilities' => array(),
			'meta_box_cb' => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
			'show_admin_column' => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
			'_builtin' => false,
			'show_in_quick_edit' => null, // по умолчанию значение show_ui
		));

	}

	public function register_widget ()
	{
		register_widget ('trueTopPostsWidget');  //registration Widget
	}

	public function register_car_form_shortcode() {

		if ( ! current_user_can( 'publish_posts' ) ) {
			return '';
		}

		if ( ! empty( $_POST['hs_insert_auto'] ) ) {
			$post_data = array(
				'post_type' => 'post_type_name',
				'post_title' => wp_strip_all_tags($_POST['post_title']),
				'post_content' => $_POST['description'],
				'tax_input' => array('taxonomy' => [$_POST['model']]),
				'post_status' => 'draft',
				'post_author' => get_current_user_id()
			);
			// Вставляем запись в базу данных
			if ( $post_data['post_title'] ) {
				$post_id = wp_insert_post( $post_data );

				if ( is_wp_error( $post_id ) ) {
					wp_safe_redirect( add_query_arg( array( 'error' => '1' ), get_permalink() ) );
					exit;
				} else {
					wp_safe_redirect( add_query_arg( array( 'successfull' => '1' ), get_permalink() ) );
					exit;
				}
			}
		}
		$args = array(
			'taxonomy' => 'taxonomy',
			'hide_empty' => false,
			'orderby' => 'name',
			'order' => 'ASC',
		);
		$terms = get_terms($args);
		?>
		<div class="car_form1">
			<?php if ( ! empty( $_GET['successfull'] ) ) { ?>
				<span><?php _e( 'Successfully Added' ) ?></span>
			<?php } elseif ( ! empty( $_GET['error'] ) ) { ?>
				<span><?php _e( 'Error' ) ?></span>
			<?php } ?>
			<form method="post" action="">
				<label for="nameAuto">Input auto</label>
				<input type="text" name="post_title" id="nameAuto">
				<br>
				<label for="nameAuto">Input model</label>
				<select name="model" id="nameAuto">
					<?php foreach ($terms as $term): ?>
						<option value="<?= $term->name ?>"><?= $term->name ?></option>
					<?php endforeach; ?>
				</select>
				<p><textarea rows="5" cols="45" name="description"></textarea></p>
				<input type="hidden" name="hs_insert_auto" value="1" />
				<input type="submit">
			</form>
		</div>
		<?php
	}

	public function register_list_car_shortcode()
	{
		if (current_user_can('publish_posts')) {
			?>
			<div style="float:left;">
				<div style="float:left;"><?php
					$query = new WP_Query(array('author' => get_current_user_id(),
							'post_type' => 'post_type_name',
							'post_status' => 'publish')
					);
					echo('<h1 style="color:black">Опубликованные посты:</h1>');
					while ($query->have_posts()) : $query->the_post(); ?>
						<a href="<?php the_permalink() ?>"
						   style="text-decoration: none;margin-left: 10px;color:black;"
						   title="<?php the_title(); ?>">
							-<?php the_title(); ?>
						</a>
						<br>

					<?php endwhile;
					wp_reset_postdata(); ?>
				</div>
				<div>
					<?php
					wp_reset_query();
					$query = new WP_Query(array('author' => get_current_user_id(),
						'post_type' => 'post_type_name',
						'post_status' => 'draft'));
					if ($query->have_posts()) {
						echo('<h1 style="color:black">Ожидающие подтверждения:</h1>');
						while ($query->have_posts()) : $query->the_post(); ?>
							<a href="<?php the_permalink() ?>"
							   style="text-decoration: none;margin-left: 10px;color:black;"
							   title="<?php the_title(); ?>">
								-<?php the_title(); ?>
							</a>
							<br>
						<?php endwhile;
						wp_reset_postdata();
					}
					?>
				</div>
			</div>
			<?php
		}
	}

}

new MyCars();