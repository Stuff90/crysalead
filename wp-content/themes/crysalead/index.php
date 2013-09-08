<?php get_header(); ?>

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
                <?php the_content(); 
                break;
            endwhile;
        ?>
	</div>
	<div class="side-image side-image-right">
		<img src="<?php bloginfo('template_url'); ?>/assets/img/office-img-2.png" alt="Cover image">
	</div>
</div>

<div class="page" id="accompaniment">
	<h4 class="main-title">Notre accompagnement</h4>
	<hr class="title-underline">
	<div class="slider-wrapper ui-max-width">
		<a href="#" class="active slider-controller slider-controller-prev"></a>
		<a href="#" class="active slider-controller slider-controller-next"></a>
		<div class="slides-wrapper"><!--
			<?php
	            $args = array( 'post_type' => 'accompagnement', 'orderby' => 'date', 'order' => 'DESC');
	            $accompagnement = new WP_Query( $args );
	            while ( $accompagnement->have_posts() ) : $accompagnement->the_post(); ?>
	            	--><div>
	            		<?php
	            			$type = get_post_meta($post->ID, 'accompagnementtype', true);
	            			if($type == 'img'){ 
	            				$cover = wp_get_attachment_image_src(get_post_meta($post->ID, 'accompagnementimagecover', true),'full');
	            				?>

								<div class="slide-centered">
									<h5 class="quotation"><?php the_title(); ?></h5>
									<p class="quotation-author"><?php echo get_post_meta($post->ID, 'accompagnementauthor', true); ?></p>
								</div>
							
								<div class="slide-centered">
									<img src="<?php echo $cover[0]; ?>">
									<p><br /><?php echo get_post_meta($post->ID, 'accompagnementsubtitle', true); ?></p>
								</div>

								<p class="slide-centered"><a href="#" class="ui-button">En savoir plus</a></p>

	            			<?php } elseif ($type == 'text') { ?>
	            				
								<div class="slide-centered">
									<h5 class="quotation"><?php the_title(); ?></h5>
									<p class="quotation-author"><?php echo get_post_meta($post->ID, 'accompagnementauthor', true); ?></p>
								</div>

								<div>
									<!-- <div class="slide-column slide-column-text">
										<p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man. You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man. You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't.</p>
									</div> -->
									<div class="slide-column slide-column-text">
										<!-- <p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man.  You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man.</p>
										<p>You think water moves fast? You should see ice. It moves like it has a mind. Like it knows it killed the world once and got a taste for murder. After the avalanche, it took us a week to climb out. Now, I don't know exactly when we turned on each other, but I know that seven of us survived the slide... and only five made it out. Now we took an oath, that I'm breaking now. We said we'd say it was the snow that killed the other two, but it wasn't. Nature is lethal but it doesn't hold a candle to man. </p> -->
										<?php the_content(); ?>
									</div>
								</div>

	            			<?php } elseif ($type == 'textimg') { 
	            				$cover = wp_get_attachment_image_src(get_post_meta($post->ID, 'accompagnementimagecover', true),'full');
	            				?>

								<div class="slide-column slide-column-img">
									<img src="<?php echo $cover[0] ?>" alt="Valérie" />
								</div>
								<div class="slide-column slide-column-text">
									<h5 class="quotation"><?php the_title(); ?></h5>
									<p class="quotation-author"><?php echo get_post_meta($post->ID, 'accompagnementauthor', true); ?></p>
									<p><em><?php echo get_post_meta($post->ID, 'accompagnementsubtitle', true); ?></em></p>
									<?php the_content(); ?>
									
									<p><a href="#" class="ui-button">En savoir plus</a></p>
								</div>

	            			<?php }
	            		?>
					</div>

	            	<!--
	                <?php 
	            endwhile;
	        ?>--></div>
		<div class="slider-menu-wrapper">
			<div class="slider-menu-selector"></div>
			<ul class="slider-menu">
				<li class="active">
					<span class="slider-menu-circle"></span>
					Projet de transformation
				</li>
				<li>
					<span class="slider-menu-circle"></span>
					Performance en période de crise
				</li>
				<li>
					<span class="slider-menu-circle"></span>
					Diversité et mixité H/F Réussies
				</li>
				<li>
					<span class="slider-menu-circle"></span>
					Réseau de femme et diversité des commités de direction
				</li>
			</ul>
		</div>
	</div>
</div>

<div class="page" id="whoareus">
	<h4 class="main-title">Qui sommes-nous ?</h4>
	<hr class="title-underline">

	<div class="portraits">
		<ul class="portraits-list">
			<?php
	            $args = array( 'post_type' => 'membrecabinet', 'orderby' => 'date', 'order' => 'ASC');
	            $home = new WP_Query( $args );
	            while ( $home->have_posts() ) : $home->the_post(); 
	            	$portrait = wp_get_attachment_image_src(get_post_meta($post->ID, 'cabinetmembreportrait', true),'full'); 
	            	?>
					<li>
						<span></span>
						<img src="<?php echo $portrait[0]; ?>">
						
					</li>
	                <?php 
	            endwhile;
	        ?>
		</ul>

		<div class="portraits-desc-list">
			<?php
	            $args = array( 'post_type' => 'membrecabinet', 'orderby' => 'date', 'order' => 'ASC');
	            $home = new WP_Query( $args );
	            while ( $home->have_posts() ) : $home->the_post();
	            	$social = get_post_meta($post->ID, 'cabinetmembresocial', true);

	            	$social = str_replace('[', '', $social);
	            	$social = str_replace(']', '', $social);
	            	$social = str_replace('"', '', $social);

	            	$social = explode(',', $social);

	             	?>
					<div>
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
	            endwhile;
	        ?>
		</div>
	</div>
</div>

<div class="page" id="co-workers">
	<h4 class="main-title">Les Collaborateurs</h4>
	<hr class="title-underline">

	<div id="co-workers-portraits"><!--
		
		<?php
	            $args = array( 'post_type' => 'collaborateurs', 'orderby' => 'date', 'order' => 'ASC');
	            $query = new WP_Query( $args );
	            while ( $query->have_posts() ) : $query->the_post();
	            	$bg = get_post_meta($post->ID, 'collaborateurportraitbg', true);
	            	$coWorkerPortrait = wp_get_attachment_image_src(get_post_meta($post->ID, 'collaborateurportrait', true),'full');
	            	?>

	            	--><div class="co-workers-portrait">
	            		<div>
	            			
	            			<div class="co-workers-portrait-bg <?php echo $bg; ?>">
	            				<div></div>
	            			</div>

	            			<figure>
	            				<img src="<?php echo $coWorkerPortrait[0]; ?>">
	            			</figure>

	            		</div>
	            		<dl>
	            			<dt><?php the_title(); ?></dt>
	            			<dd class="bar"></dd>
	            			<dd><?php echo get_post_meta($post->ID, 'collaborateurrole', true); ?></dd>
	            		</dl>
	            	</div><!--

	            	<?php
	            endwhile;

	            ?>

	--></div>
</div>

<div class="page" id="contact">
	<h4 class="main-title">Contact</h4>
	<hr class="title-underline">

	<p>Vous souhaitez faire intervenir un de nos coachs au sein de votre société</p>

	<form method="POST" action="#">
		<fieldset>
			<input type="text" name="name" placeholder="NOM" />
			<input type="text" name="firm" placeholder="SOCIETE" />
		</fieldset>
		<fieldset>
			<input type="text" name="email" placeholder="EMAIL" />
			<input type="text" name="phone" placeholder="TEL" />
		</fieldset>

		<select name="doc">
			<option value="doc1">Demande de doc 1</option>
			<option value="doc2">Demande de doc 2</option>
		</select>

		<input type="text" name="object" placeholder="OBJET" />
		<textarea name="msg">BONJOUR, ...</textarea>

		<input type="submit" id="submit" value="ENVOYER" />
	</form>
</div>

<?php get_footer(); ?>