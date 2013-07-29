<?php
class cubetechPortfolioWidget extends WP_Widget {
	private $fields = array(
		'title'          => 'Titel (optional)'
	);

	function cubetechPortfolioWidget() {
		$widget_ops = array('classname' => 'cubetech_portfolio_widget', 'description' => 'Zeigt einen Slider mit den Referenzen.');
		$this->WP_Widget('cubetech_portfolio_widget', 'Referenzen', $widget_ops);
	}

	function widget($args, $instance) {
		$args = array(
			'posts_per_page'  	=> 15,
			'numberposts'     	=> 15,
			'offset'          	=> 0,
			'post_type'       	=> 'cubetech_portfolio',
			'post_status'     	=> 'publish',
			'suppress_filters' 	=> true
		);
		if($instance['show'] == 'group') {
			$args['tax_query'] = 
				array( array(
					'taxonomy' => 'cubetech_group',
					'field' => 'slug',
					'terms' => $instance['cubetech_group']
				));
		}
		$posts = get_posts($args);
		?>
		<h3>Success Stories</h3>
		<div id="carousel_portfolio" class="carousel slide">
			<!-- Carousel items -->
			<ol class="carousel-indicators">
				<?php
					$i = 0;
					foreach ($posts as $post) {
						if($instance['show'] == 'group' || ($instance['show'] == 'all' && get_post_meta($post->ID, 'featured', true))) {
							echo '<li data-target="#carousel_portfolio" data-slide-to="', $i, '"';
							if($i == 0) {
								echo ' class="active"';
							}
							echo '></li>';
							$i++;
						}
					}
				?>
			</ol>
			<div class="carousel-inner">
				<?php
				foreach ($posts as $post) {
					if($instance['show'] == 'group' || ($instance['show'] == 'all' && get_post_meta($post->ID, 'featured', true))) {
						$attachments = get_post_meta($post->ID, 'attachments', true);
						?>
						<div class="item <?php if(!isset($notfirst)) { $notfirst = true; echo 'active'; } ?>">
							<div class="row-fluid">
								<div class="span8">
									<a href="<?php echo get_permalink($post->ID); ?>" class=""><h5 class="cubetech-portfolio-title">
										<?php
											if(has_excerpt($post->ID)) echo $post->post_excerpt; else echo $post->post_title; 
										?>
									</h5></a>
									<div class="cubetech-portfolio-content">
										<?php
											echo $post->post_content;
										?>
									</div>
								</div>
								<div class="span4">
									<?php if(get_post_meta($post->ID, 'attachments', true)) { ?>
									<h5 class="cubetech-portfolio-downloads">Downloads</h5>
									<div class="cubetech-portfolio-downloads-content">
										<?php foreach ($attachments as $attachment) { 
											$info = get_post($attachment); ?>
											<a href="<?php echo wp_get_attachment_url($attachment); ?>"><?php if($info->post_excerpt) { echo $info->post_excerpt; } else { echo $info->post_title; } ?></a><br/>
										<?php } ?>
									</div>
									<?php } if(has_post_thumbnail($post->ID)) { ?>
										<div class="cubetech-portfolio-logo">
											<?php echo get_the_post_thumbnail($post->ID, 'full'); ?>
										</div>
									<?php } ?>
								</div>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
			<!-- Carousel nav -->
			<a class="carousel-control left" href="#carousel_portfolio" data-slide="prev">&lsaquo;</a>
			<a class="carousel-control right" href="#carousel_portfolio" data-slide="next">&rsaquo;</a>
		</div>
		<?php
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
        $instance['cubetech_group'] = strip_tags($new_instance['cubetech_group']);
        if(!isset($new_instance['show'])) {
			$new_instance['show'] = 'all';
		}
        $instance['show'] = strip_tags($new_instance['show']);
        return $instance;
	}

	function form($instance) {
		$terms = get_terms(array('cubetech_group'));
		?>
		<label><input type="radio" name="<?php echo $this->get_field_name('show'); ?>" id="show_all_radio" value="all" <?php 
			if(isset($instance['show']) && $instance['show'] == 'all') { 
				echo $instance['show'] == 'all' ? 'checked="checked"' : ''; 
			} 
		?> /> Alle anzeigen</label><br />
		<label><input type="radio" name="<?php echo $this->get_field_name('show'); ?>" id="show_group_radio" value="group" <?php 
			if(isset($instance['show']) && $instance['show'] == 'group') { 
				echo $instance['show'] == 'group' ? 'checked="checked"' : ''; 
			} 
		?> /> Ausgewählte Gruppe</label><br />
		<label for="<?php echo $this->get_field_name('cubetech_group'); ?>">Gruppe:</label>
		<select name="<?php echo $this->get_field_name('cubetech_group'); ?>" id ="<?php echo $this->get_field_name('cubetech_group'); ?>">
			<?php 
			foreach($terms as $term) {
				?>
				<option <?php echo $instance['cubetech_group'] == $term->slug ? 'selected="selected"' : ''; ?> value="<?php echo $term->slug; ?>"><?php echo $term->name; ?></option>
				<?php
			}
			?>
		</select>
		<?php
	}
}

function cubetech_portfolio_register_widgets() {
	register_widget( 'cubetechPortfolioWidget' );
}

add_action( 'widgets_init', 'cubetech_portfolio_register_widgets' );
?>
