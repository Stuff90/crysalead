<?php get_header(); 

	$asideContent = array();

    $args = array( 'post_type' => 'entrepage', 'orderby' => 'date', 'order' => 'ASC');
    $aside = new WP_Query( $args );
    while ( $aside->have_posts() ) : $aside->the_post();

    	$nb = (int) get_post_meta($post->ID, 'entrepagepage', true);

    	$asideContent[$nb] = array(

    		'text' => get_post_meta($post->ID, 'entrepagestext', true),
    		'image' => wp_get_attachment_image_src(get_post_meta($post->ID, 'entrepagesimage', true),'full')

    	);

    endwhile;
?>

<div class="page" id="office">
	<div class="side-image side-image-left">
		<img src="<?php bloginfo('template_url'); ?>/assets/img/office-img-1.png" alt="Cover image">
	</div>
	<div class="side-image side-image-center">
		<?php
            $args = array( 'post_type' => 'cabinet', 'orderby' => 'date', 'order' => 'ASC','posts_per_page' => 1);
            $home = new WP_Query( $args );
            while ( $home->have_posts() ) : $home->the_post(); ?>
                <h4 class="main-title"><?php the_title(); ?></h4>
				<hr class="title-underline">
				<div id="office-content-wrapper">
					<div id="office-content">
	                	<?php the_content(); ?> 
					</div>
				</div>
				<?php	
                break;
            endwhile;
        ?>
	</div>
	<div class="side-image side-image-right">
		<img src="<?php bloginfo('template_url'); ?>/assets/img/office-img-2.png" alt="Cover image">
	</div>

</div>

<?php 
	if(isset($asideContent[1])){
		if(strlen($asideContent[1]['text']) !== 0){ ?>

			<div id="aside" style="background-image:url(<?php echo $asideContent[1]['image'][0]; ?>)">
				<p><?php echo $asideContent[1]['text'] ?></p>
			</div>


		<?php }
	}
?>


<div class="page" id="accompaniment">
	<h4 class="main-title">Notre accompagnement</h4>
	<hr class="title-underline">
	<div class="slider-wrapper ui-max-width">
		<a href="#" class="active slider-controller slider-controller-prev"></a>
		<a href="#" class="active slider-controller slider-controller-next"></a>
		<div class="slides-wrapper"><!--
			<?php
				$titles = array();
	            $args = array( 'post_type' => 'accompagnement', 'orderby' => 'date', 'order' => 'ASC');
	            $accompagnement = new WP_Query( $args );
	            while ( $accompagnement->have_posts() ) : $accompagnement->the_post(); ?>
	            	--><div class="slide">
	            		<?php
	            		$column = false;
	            		// var_dump(strlen(get_post_meta($post->ID, 'accompagnementcolumntwo', true)));
	        			if(strlen(get_post_meta($post->ID, 'accompagnementcolumntwo', true)) !== 0) {
	        				$column = 'column';
	        			} ?>
		            	<div class="<?php echo $column ?>">
		            		<?php
		            			echo get_post_meta($post->ID, 'accompagnementcolumnone', true);
		            		?>
						</div>
	            		<?php
	        			if($column == 'column') { ?>
	        				<div class="column">
	        					<?php echo get_post_meta($post->ID, 'accompagnementcolumntwo', true); ?>
	        				</div>
	        			<?php } ?>
	            	</div><!--
	            <?php endwhile;
	        ?>--></div>
		<div class="slider-menu-wrapper">
			<div class="slider-menu-selector"></div>
			<ul class="slider-menu">
				<?php
					$isFirst  = 1;
					$args = array( 'post_type' => 'accompagnement', 'orderby' => 'date', 'order' => 'ASC');
		            $accompagnement = new WP_Query( $args );
		            while ( $accompagnement->have_posts() ) : $accompagnement->the_post();
		            	$active = '';
		            	if($isFirst){
		            		$active = 'active';
		            	}
						?>
							<li class="<?php echo $active; ?>">
								<span class="slider-menu-circle"></span>
								<?php the_title(); ?>
							</li>
						<?php
						$isFirst = 0;
	            	endwhile;
				?>
			</ul>
		</div>
	</div>

</div>

<?php 
	if(isset($asideContent[2])){
		if(strlen($asideContent[2]['text']) !== 0){ ?>

			<div id="aside" style="background-image:url(<?php echo $asideContent[2]['image'][0]; ?>)">
				<p><?php echo $asideContent[2]['text'] ?></p>
			</div>


		<?php }
	}
?>

<div class="page" id="whoareus">
	<h4 class="main-title">Qui sommes-nous ?</h4>
	<hr class="title-underline">

	<div class="portraits">
		<ul class="portraits-list">
			<?php
				$isFirst = 1;
	            $args = array( 'post_type' => 'membrecabinet', 'orderby' => 'date', 'order' => 'DESC');
	            $home = new WP_Query( $args );
	            while ( $home->have_posts() ) : $home->the_post(); 
	            	$portrait = wp_get_attachment_image_src(get_post_meta($post->ID, 'cabinetmembreportrait', true),'full'); 
	            	?>
					<li class="active">
						<img src="<?php echo $portrait[0]; ?>">
						<span></span>
						
					</li>
	                <?php 
					$isFirst = 0;
	            endwhile;
	        ?>
		</ul>

		<div class="portraits-desc-list">
			<?php
				$isFirst = 1;
	            $args = array( 'post_type' => 'membrecabinet', 'orderby' => 'date', 'order' => 'DESC');
	            $home = new WP_Query( $args );
	            while ( $home->have_posts() ) : $home->the_post();
	            	$social = get_post_meta($post->ID, 'cabinetmembresocial', true);

	            	$social = str_replace('[', '', $social);
	            	$social = str_replace(']', '', $social);
	            	$social = str_replace('"', '', $social);

	            	$social = explode(',', $social);

	            	$active = '';
	            	if($isFirst){
	            		$active = 'active';
	            	}
	             	?>
					<div class="<?php echo $active; ?>">
						<h5><?php the_title(); ?></h5>
						<hr />
						<h6><?php echo get_post_meta($post->ID, 'cabinetmembrerole', true); ?></h6>
						<p><?php echo get_post_meta($post->ID, 'cabinetmembrepresentationtext', true); ?></p>
						<ul>
							<?php
								foreach ($social as $aSocial) { 
									$icon = 'linkedin';

									$icon = (strpos($aSocial, 'facebook') !== false)?'facebook':$icon;
									$icon = (strpos($aSocial, 'twitter') !== false)?'twitter':$icon;
									$icon = (strpos($aSocial, 'viadeo') !== false)?'viadeo':$icon;

									?>
										<li><a href="<?php echo $aSocial; ?>" target="_blank" class="icon <?php echo $icon; ?>"></a></li>
									<?php
								}
							?>
						</ul>
						<p class="portrait-email"><?php echo get_post_meta($post->ID, 'cabinetmembremail', true); ?></p>
					</div>
	                <?php 
	                $isFirst = 0;
	            endwhile;
	        ?>
		</div>
	</div>
</div>

<?php 
	if(isset($asideContent[3])){
		if(strlen($asideContent[3]['text']) !== 0){ ?>

			<div id="aside" style="background-image:url(<?php echo $asideContent[3]['image'][0]; ?>)">
				<p><?php echo $asideContent[3]['text'] ?></p>
			</div>

		<?php }
	}
?>

<div class="page" id="co-workers">
	<h4 class="main-title">Les Partenaires</h4>
	<hr class="title-underline">

	<a href="#" class="slider-controller slider-controller-prev"></a>
	<a href="#" class="active slider-controller slider-controller-next"></a>

	<div id="co-workers-portraits"><!--
		--><div class="active co-workers-portraits-slide"><!--
		<?php
				$i = 0;
	            $args = array( 'post_type' => 'collaborateurs', 'orderby' => 'date', 'order' => 'DESC');
	            $query = new WP_Query( $args );
	            while ( $query->have_posts() ) : $query->the_post();
	            	$bg = get_post_meta($post->ID, 'collaborateurportraitbg', true);
	            	$coWorkerPortrait = wp_get_attachment_image_src(get_post_meta($post->ID, 'collaborateurportrait', true),'full');
					?>
	            	--><div class="co-workers-portrait">
	            		<div>
							<img src="<?php echo $coWorkerPortrait[0]; ?>">
	            			<p class="<?php echo $bg; ?>"><a target="_blank" href="mailto:<?php echo get_post_meta($post->ID, 'collaborateurmail', true); ?>"><span><?php echo get_post_meta($post->ID, 'collaborateurmail', true); ?></span></a></p>
	            		</div>

	            		<h5><?php the_title(); ?></h5>
						<hr />
						<h6><?php echo get_post_meta($post->ID, 'collaborateurrole', true); ?></h6>
	            	</div><!--

	            	<?php
	            	$i++;
	            	if ($i % 3 == 0) { ?>
	            		--></div><div class="co-workers-portraits-slide"><!--
	            	<?php }
	            endwhile;
	            ?>
		--></div><!--
	--></div>
</div>

<?php 
	if(isset($asideContent[4])){
		if(strlen($asideContent[4]['text']) !== 0){ ?>

			<div id="aside" style="background-image:url(<?php echo $asideContent[4]['image'][0]; ?>)">
				<p><?php echo $asideContent[4]['text'] ?></p>
			</div>

		<?php }
	}
?>

<div class="page" id="contact">
	<h4 class="main-title">Contact</h4>
	<hr class="title-underline">

	<p>Vous souhaitez faire intervenir un de nos coachs au sein de votre société</p>

	<?php echo do_shortcode('[contact-form-7 id="34" title="Formulaire de Contact"]'); ?>

	<p id="copyright"><?php echo date('Y'); ?> Crysalead - Tous droits réservés</p>
</div>

<?php get_footer(); ?>