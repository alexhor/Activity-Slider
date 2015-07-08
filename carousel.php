<?php
defined( 'ABSPATH' ) or die( 'Please return to the main page' );

function HS_as_shortcode( $args ){
	if( isset( $args['category'] ) && term_exists( $args['category'] ) ){
		$category = term_exists( $args['category'] );
	}
	else{
		$category = get_option( 'default_category' );
	}
	
	?>
	<div id="activity_slider" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<!-- Wrapper for slides -->
			<?php
			$i = 0;
			
			$inner = '<div class="carousel-inner" role="listbox">';
				$the_query = new WP_Query(array(
					'cat' => $category
				));
				$first_item = true;
				while ( $the_query->have_posts() ){ 
					$the_query->the_post();
					if( $first_item ){
						$inner .= '<div class="item active">';
					}
					else{
						$inner .= '<div class="item">';
					}
					
					if( has_post_thumbnail( get_the_ID() ) ){
						$image = get_the_post_thumbnail( get_the_ID(), 'large', array( 'class' => 'HS_as_fullscreen_img' ) );
					}
					else{
						$image = '<img src="' . plugins_url( '/blank.png', __FILE__ ) . '" class="HS_as_fullscreen_img wp-post-image">';
					}
						$inner .= preg_replace( "/height=\"(\d*)\"/", '', preg_replace( "/width=\"(\d*)\"/", '', $image ) );
						$inner .= '<div class="carousel-caption">';
							if( get_post()->post_title != '' ){
								$inner .= '<h2>' . apply_filters( 'the_title', get_the_title() ) . '</h2>';
							}
							
							if( get_post()->post_content != '' ){
								$inner .= '<div class="carousel-content">' . apply_filters( 'the_content', get_the_content() ) . '</div>';
							}
						$inner .= '</div>';
					$inner .= '</div><!-- item active -->';
					
					if( $first_item ){
						echo '<li data-target="#activity_slider" data-slide-to="' . $i . '" class="active"></li>';
					}
					else{
						echo '<li data-target="#activity_slider" data-slide-to="' . $i . '"></li>';
					}
					
					$i++;
					$first_item = false;
				}
			$inner .= '</div>';
			?>
		</ol>
		<?php echo $inner; ?>
		<!-- Controls -->
		<a class="left carousel-control" href="#activity_slider" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		</a>
		<a class="right carousel-control" href="#activity_slider" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		</a>
		<span class="glyphicon glyphicon-fullscreen HS_FullScreen_button" aria-hidden="true" onclick="HS_as_fullscreen( event )"></span>
	</div>
	<?php
}
add_shortcode( 'activity-slider', 'HS_as_shortcode' );