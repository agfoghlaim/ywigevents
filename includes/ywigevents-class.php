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
		echo '<div class="container"><div class="row ywig-events-content">';

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
		}
		// echo esc_html__( 'Hello, World!', 'ywig_domain' );
	 ?>
				<?php $args= array('post_type'=> 'tribe_events','posts_per_page'=>'3');query_posts( $args ); ?>
			
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php 
					//meta from tribe event will have _EventURL,_EventStartDate
					$eventurl = get_post_meta( get_the_ID(), '_EventURL', true );
					$eventstart = get_post_meta( get_the_ID(), '_EventStartDate', true );
					?>
				<?php 	$url = get_post_permalink(); ?>
				<?php echo '<div class="col-md-4" ><h4 class="text-left">';?>
				<?php echo '<a href="'.$url.'"><strong>'; ?>
					<?php the_title(); echo '</strong></a></h4>';?>

	
				<!--    	<div style="color:#1e9e6b"  >
						<i class="fas fa-calendar-check fa-5x"></i>
					</div> -->
				   	<?php
				   	the_excerpt();
				  	$meta_date = get_post_meta(get_the_ID(), 'ywig-event-date', true);
					$meta_time = get_post_meta(get_the_ID(), 'ywig-event-time', true);
						if(!empty($meta_date)){
							echo '<p><strong>Date</strong>  '.$meta_date.'</p>';
						}
						
						if(!empty($meta_time)){
							echo '<p><strong>Time</strong>  '.$meta_time.'</p>';
						}
				?>
				  <!-- 	<?php the_excerpt(); ?> -->
								   <?php 
				   echo '<a href="'.$url.'">'; the_post_thumbnail(); echo '</a>'; 
				   ?>
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