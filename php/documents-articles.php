<!-- Code sample: Checks if an ACF is selected for an document (left section) and blog post (right section). If the ACFs are not selected, for the left section, php code checks for selected 'topics' custom post type for the current page and the right section checks for a 'category' blog post. -->

<section class="pt-4 py-lg-3 py-lg-5 mt-3">
	<h3 class="text-center pb-3 pb-lg-4 px-2 px-lg-3">Documents & Articles</h3>
	<div class="container container--assets">
		<div class="row gx-1">
			<?php $assets = get_field ('asset');
			$blogs = get_field ('blog_article'); ?>

			<?php if( $assets ): 
				foreach( $assets as $asset ): ?>
				<article class="col-md-6 pb-4">
					<figure class="figure position-relative overflow-hidden w-100 img-height-control-320 mb-2">
						<a class="text-decoration-none" href="<?php echo wp_get_attachment_url( $asset->ID ); ?>" rel="attachment" target="_blank"><?php echo get_the_post_thumbnail($asset->ID, 'large');?></a>
						<div class="position-absolute left-0 bottom-0 overflow-hidden z-2" style="width: 130%;">
							<h6 class="d-inline text-bg-secondary z-2 mb-0 ps-3 ps-md-4 py-4">
							<?php
							$terms = get_the_terms( $asset->ID, 'topics' );
							$term = array_pop($terms);
							echo '<a class="text-decoration-none text-uppercase text-white" href="'.get_term_link($term->slug, 'topics').'">'.$term->slug.'</a>'; ?>
							</h6>
							<svg class="d-inline" style="margin-left: -5px; position: relative; z-index: -1;" width="84" height="50" xmlns="http://www.w3.org/2000/svg"><path d="M83.688 50c-16.813 0-32.142-9.58-39.496-24.66l-.32-.68C36.518 9.58 21.189 0 4.396 0H0v50h83.688Z" fill="#0050BF" fill-rule="evenodd"/></svg>
						</div>
					</figure>
					<div class="px-3">
						<h4 class="pe-md-3"><a class="text-decoration-none" href="<?php echo wp_get_attachment_url( $asset->ID ); ?>" rel="attachment" target="_blank"><?php echo $asset->post_title; ?></a></h4>
						<a class="btn btn-outline-dark my-2" href="<?php echo wp_get_attachment_url( $asset->ID ); ?>" rel="attachment" target="_blank">Download</a>
					</div>
				</article>
				<?php endforeach; ?>
				<?php else:
					$page_titles = array(
						'default' => array('news', 'general'),
						'compliance-testing' => array('testing'),
						'support' => array('support', 'news'),
						'manufacturing' => array('manufacturing'),
						'utilities' => array('utilities'),
						'commercial' => array('commercial'),
						'medical' => array('medical'),
						'healthcare' => array('healthcare', 'trends', 'news-events'),
					);

					$current_page_title = is_front_page() ? 'default' : get_the_title();

					$args = array(
						'post_type' => 'attachment',
						'posts_per_page' => 1,
						'tax_query' => array(
							'relation' => 'OR',
							array(
								'taxonomy' => 'topics',
								'terms' => $page_titles[$current_page_title],
								'field' => 'slug',
							),
						),
					);
					$allattachments = get_posts( $args );
					foreach ( $allattachments as $post ) : setup_postdata( $post ); ?>
						<article class="col-md-6 pb-4">
							<figure class="figure position-relative overflow-hidden w-100 img-height-control-320 mb-2">
								<a class="text-decoration-none" href="<?php echo esc_url( wp_get_attachment_url( $post->ID ) ); ?>" rel="attachment" target="_blank"><?php $img_atts = the_post_thumbnail($IMG_ID, 'large');?></a>
								<div class="position-absolute left-0 bottom-0 overflow-hidden z-2" style="width: 130%;">
									<h6 class="d-inline text-bg-secondary z-2 mb-0 ps-3 ps-md-4 py-4">
									<?php
									$terms = get_the_terms( $post->ID, 'topics' );
									$term = array_pop($terms);
									echo '<a class="text-decoration-none text-uppercase text-white" href="'.get_term_link($term->slug, 'topics').'">'.$term->name.'</a>'; ?>
									</h6>
									<svg class="d-inline" style="margin-left: -5px; position: relative; z-index: -1;" width="84" height="50" xmlns="http://www.w3.org/2000/svg"><path d="M83.688 50c-16.813 0-32.142-9.58-39.496-24.66l-.32-.68C36.518 9.58 21.189 0 4.396 0H0v50h83.688Z" fill="#0050BF" fill-rule="evenodd"/></svg>
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
									<div class="position-absolute left-0 bottom-0 overflow-hidden z-2" style="width: 130%;">
										<h6 class="d-inline text-bg-secondary text-uppercase z-2 mb-0 ps-3 ps-md-4 py-4">
											<?php
											$terms = get_the_terms( $blog->ID, 'category' );
											$term = array_pop($terms);
											echo '<a class="text-decoration-none text-uppercase text-white" href="'.get_term_link($term->slug, 'category').'">'.$term->slug.'</a>'; ?>
											</h6>
										<svg class="d-inline" style="margin-left: -5px; position: relative; z-index: -1;" width="84" height="50" xmlns="http://www.w3.org/2000/svg"><path d="M83.688 50c-16.813 0-32.142-9.58-39.496-24.66l-.32-.68C36.518 9.58 21.189 0 4.396 0H0v50h83.688Z" fill="#0050BF" fill-rule="evenodd"/></svg>
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
					$page_categories = array(
						'default' => array(120, 114),
						'compliance-testing' => array(112, 120, 114),
						'support' => array(120, 114),
						'manufacturing' => array(112),
						'utilities' => array(113),
						'commercial' => array(109),
						'medical' => array(111, 120, 114),
						'healthcare' => array(110),
					);

					$current_page_title = get_the_title();
					$category_array = isset($page_categories[$current_page_title]) ? $page_categories[$current_page_title] : $page_categories['default'];

					$new_query = new WP_Query(
						array(
							'post_type' => 'post',
							'posts_per_page' => 1,
							'cat' => $category_array,
						)
					);
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
												<div class="position-absolute left-0 bottom-0 overflow-hidden z-2" style="width: 130%;">
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
														}
														?></h6>
													<svg class="d-inline" style="margin-left: -5px; position: relative; z-index: -1;" width="84" height="50" xmlns="http://www.w3.org/2000/svg"><path d="M83.688 50c-16.813 0-32.142-9.58-39.496-24.66l-.32-.68C36.518 9.58 21.189 0 4.396 0H0v50h83.688Z" fill="#0050BF" fill-rule="evenodd"/></svg>
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