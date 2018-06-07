<?php
/**
 * Adds Foo_Widget widget.
 */
class Ywig_Events_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ywigevents_widget', // Base ID
			esc_html__( 'Ywig Events', 'ywig_domain' ), // Name
			array( 'description' => esc_html__( 'Display posts by category', 'ywig_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		echo '<div class="container"><div class="row">';

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		// echo esc_html__( 'Hello, World!', 'ywig_domain' );
	 ?>
				<?php query_posts('cat=4&posts_per_page=3'); ?>
			
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

				<?php 	$url = get_post_permalink(); ?>
				<?php echo '<div class="col-md-4" ><h4>';?>
					<?php the_title(); echo '</h4>';?>
				   <?php 
				   echo '<a href="'.$url.'">'; the_post_thumbnail(); echo '</a>'; 
				   ?>
				<!--    	<div style="color:#1e9e6b"  >
						<i class="fas fa-calendar-check fa-5x"></i>
					</div> -->
				   	<?php
				  	$meta_date = get_post_meta(get_the_ID(), 'Event Date', true);
					$meta_location = get_post_meta(get_the_ID(), 'Event Location', true);
						if(!empty($meta_date)){
							echo '<p><i class="fas fa-clock "></i><small>  '.$meta_date.'</small></p>';
						}
						
						if(!empty($meta_location)){
							echo '<p><i class="fas fa-location-arrow "></i><small>   '.$meta_location.'</small></p>';
						}
				?>
				  <!-- 	<?php the_excerpt(); ?> -->
				
				   <?php echo '</div>'; ?>
			
				<?php endwhile; endif; ?>
					<div class="row">
						<a class="btn dark-pink-btn">All Events</a>
					</div>
				<?php wp_reset_query(); ?>


	<?php
		echo $args['after_widget'];
		echo '</div></div>';
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'ywig_domain' );
		?>
		<p>
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'ywig_domain' ); ?></label> 
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Foo_Widget