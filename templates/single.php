<div class="page-content cubetech-events">
	<?php while (have_posts()) : the_post();
	$post_meta_data = get_post_custom(get_the_ID()); ?>
	<article <?php post_class(); ?>>
		<header>
			<div class="row-fluid">
				<div class="span7"><?php echo get_the_post_thumbnail( get_the_ID(), 'cubetech-events-thumb', array('class' => 'cubetech-events-thumb') ); ?></div>
				<div class="span9">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<div class="cubetech-events-short"><?php echo $post_meta_data['cubetech_events_short'][0]; ?></div>
					<div class="cubetech-events-meta">
						<div class="row-fluid">
							<div class="span4">
								<strong>Datum</strong>
							</div>
							<div class="span12"><?php echo $post_meta_data['cubetech_events_startdate'][0] ?><?php if($post_meta_data['cubetech_events_enddate'][0]!='') echo ' bis ' . $post_meta_data['cubetech_events_enddate'][0]; ?></div>
						</div>
						<div class="row-fluid">
							<div class="span4">
								<strong>Ort</strong>
							</div>
							<div class="span12"><?php echo $post_meta_data['cubetech_events_location'][0] ?></div>
						</div>
						<div class="row-fluid">
							<div class="span12 offset4">
								<a href="http://maps.google.ch/?q=<?php echo $post_meta_data['cubetech_events_location'][0] ?>" target="_blank">Auf Google Maps anzeigen</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
		<footer>
			<a href="javascript:history.back();" class="btn btn-back">Zurück</a>
		</footer>
	</article>
	<?php endwhile; ?>
</div>