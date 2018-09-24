<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();

abstract class Good{

}

class Car
{
    protected $speed;
    const MARK = 'bugatti';

    public function __construct($speed)
    {
        $this->speed = $speed;
    }

    protected function showConst()
    {
        echo 'I`m protected function , its const: ' . self::MARK;
    }
}

class FlyCar extends Car{
    private $height;
    public function __construct($height)
    {
        parent::__construct($speed=240);
        $this->height=$height;
        $this->showConst();
    }

    public function showAll(){
        echo($this->height.'<br>'.$this->speed);
    }

}
$b=123.42;
$flycar= new FlyCar($b);

