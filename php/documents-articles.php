<!-- Code sample: Checks if an ACF is selected for an document (left section) and blog post (right section). If they are not selected, code checks for the specific 'documents' category for the current page and displays the document or blog post. -->

<section class="pt-4 py-lg-3 py-lg-5 mt-3">
	<h3 class="text-center pb-3 pb-lg-4 px-2 px-lg-3">Documents & Articles</h3>
	<div class="container">
		<div class="row gx-1">
			<?php $documents = get_field ('document');
			$blogs = get_field ('blog_article'); ?>

			<?php if( $documents ): 
				foreach( $documents as $document ): ?>
				<article class="col-md-6 pb-4">
					<figure class="figure position-relative overflow-hidden w-100 img-height-control-320 mb-2">
						<a class="text-decoration-none" href="<?php echo wp_get_attachment_url( $document->ID ); ?>" rel="attachment" target="_blank"><?php echo get_the_post_thumbnail($document->ID, 'large');?></a>
						<div class="position-absolute left-0 bottom-0 overflow-hidden z-2">
							<h6 class="d-inline text-bg-secondary z-2 mb-0 ps-3 ps-md-4 py-4">
							<?php
							$terms = get_the_terms( $document->ID, 'documents' );
							$term = array_pop($terms);
							echo '<a class="text-decoration-none text-uppercase text-white" href="'.get_term_link($term->slug, 'documents').'">'.$term->slug.'</a>'; ?>
							</h6>
						</div>
					</figure>
					<div class="px-3">
						<h4 class="pe-md-3"><a class="text-decoration-none" href="<?php echo wp_get_attachment_url( $document->ID ); ?>" rel="attachment" target="_blank"><?php echo $document->post_title; ?></a></h4>
						<a class="btn btn-outline-dark my-2" href="<?php echo wp_get_attachment_url( $document->ID ); ?>" rel="attachment" target="_blank">Download</a>
					</div>
				</article>
				<?php endforeach; ?>
				<?php else:
					if ( is_front_page() ) {
						$args = array(
							'post_type' => 'attachment', 
							'posts_per_page' => '1',
							'tax_query' => array(
								'relation' => 'OR',
								array(
									'taxonomy' => 'documents',
									'terms' => array( 'general', 'news' ),
									'field' => 'slug',
								)
							)
						);
					}
					if ( is_page('code-sample') ) {
						$args = array(
							'post_type' => 'attachment', 
							'posts_per_page' => '1',
							'tax_query' => array(
								'relation' => 'OR',
								array(
									'taxonomy' => 'documents',
									'terms' => array( 'code' ),
									'field' => 'slug',
								)
							)
						);
					}
					$allattachments = get_posts( $args );
					foreach ( $allattachments as $post ) : setup_postdata( $post ); ?>
						<article class="col-md-6 pb-4">
							<figure class="figure position-relative overflow-hidden w-100 img-height-control-320 mb-2">
								<a class="text-decoration-none" href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" rel="attachment" target="_blank"><?php $img_atts = the_post_thumbnail($IMG_ID, 'large');?></a>
								<div class="position-absolute left-0 bottom-0 overflow-hidden z-2">
									<h6 class="d-inline text-bg-secondary z-2 mb-0 ps-3 ps-md-4 py-4">
									<?php
									$terms = get_the_terms( $post->ID, 'documents' );
									$term = array_pop($terms);
									echo '<a class="text-decoration-none text-uppercase text-white" href="'.get_term_link($term->slug, 'documents').'">'.$term->name.'</a>'; ?>
									</h6>
								</div>
							</figure>
							<div class="px-3">
								<h4 class="pe-md-3"><a class="text-decoration-none" href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" rel="attachment" target="_blank"><?php the_title(); ?></a></h4>
								<a class="btn btn-outline-dark my-2" href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" rel="attachment" target="_blank">Download</a>
							</div>
						</article>
					<?php endforeach; 
				wp_reset_postdata();?>
			<?php endif; ?>

			<?php if( $blogs ): 
				foreach( $blogs as $blog ): ?>
				<article id="post-<?php echo $blog->ID; ?>" <?php post_class('col-md-6'); ?>>
					<div class="bg-white h-100">
						<div class="entry-summary">
							<a href="<?php echo get_the_permalink($blog->ID); ?>">
								<figure class="figure position-relative overflow-hidden w-100 img-height-control-320 mb-2 bg-dark">
									<?php echo get_the_post_thumbnail($blog->ID, 'medium_large', array('class' => 'figure-img h-100 w-auto position-absolute top-50 start-50 translate-middle z-1')); ?>
									<div class="position-absolute left-0 bottom-0 overflow-hidden z-2">
										<h6 class="d-inline text-bg-secondary text-uppercase z-2 mb-0 ps-3 ps-md-4 py-4">
											<?php
											$terms = get_the_terms( $blog->ID, 'category' );
											$term = array_pop($terms);
											echo '<a class="text-decoration-none text-uppercase text-white" href="'.get_term_link($term->slug, 'category').'">'.$term->slug.'</a>'; ?>
										</h6>

									</div>
								</figure>
							</a>
						</div>
						<div class="px-3 pb-4">
							<h3 class="h4 pe-md-3 entry-title" itemprop="headline">
								<a class="text-decoration-none" href="<?php echo get_the_permalink($blog->ID); ?>" rel="bookmark"><?php echo $blog->post_title; ?></a>
							</h3>
							<a class="btn btn-outline-dark my-2" href="<?php echo get_the_permalink($blog->ID); ?>" rel="bookmark">Read More</a>
						</div>
					</div>
				</article>
				<?php endforeach; ?>
				<?php else:
					if ( is_front_page() ) { 
						$new_query = new WP_Query(
							array(
								'post_type'         => 'post',
								'posts_per_page'    => 1,
								'cat'    => array (120, 114)
							)
						);
					}
					if ( is_page('code-sample') ) { 
						$new_query = new WP_Query(
							array(
								'post_type'         => 'post',
								'posts_per_page'    => 1,
								'cat'    => array (130)
							)
						);
					}
					if ($new_query->have_posts()) {
						$i = 0;
						while ($new_query->have_posts()) {
							$new_query->the_post();
							$postid = get_the_ID(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('col-md-6'); ?>>
								<div class="bg-white h-100">
									<div class="entry-summary">
										<a href="<?php the_permalink(); ?>">
											<figure class="figure position-relative overflow-hidden w-100 img-height-control-320 mb-2 bg-dark">
												<?php the_post_thumbnail('medium_large', array('class' => 'figure-img h-100 w-auto position-absolute top-50 start-50 translate-middle z-1')); ?>
												<div class="position-absolute left-0 bottom-0 overflow-hidden z-2">
													<h6 class="d-inline text-bg-secondary text-uppercase z-2 mb-0 ps-3 ps-md-4 py-4">
													<?php
													$specific_category_id = 114;
													$categories = get_the_category();
													if (!empty($categories)) {
														foreach ($categories as $category) {
															if ($category->term_id === $specific_category_id) {
																// Use the specific category if it exists
																$primary_category = $category;
																break;
															}
														}
														// If the specific category doesn't exist, fall back to the first category
														if (!isset($primary_category)) {
															$primary_category = $categories[0];
														}
														// Display the primary category name and link
														echo '<a class="text-decoration-none text-white" href="' . esc_url(get_category_link($primary_category->term_id)) . '">' . esc_html($primary_category->name) . '</a>';
													} ?>
													</h6>
			
												</div>
											</figure>	
										</a>
									</div>
									<div class="px-3 pb-4">
										<h3 class="h4 pe-md-3 entry-title" itemprop="headline">
											<a class="text-decoration-none" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
										</h3>
										<a class="btn btn-outline-dark my-2" href="<?php the_permalink(); ?>" rel="bookmark">Read More</a>
									</div>
								</div>
							</article>
						<?php
						}
					}
				wp_reset_postdata(); 
			endif; ?>
		</div>
	</div>
</section>