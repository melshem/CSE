<?php /* Template Name: Code Sample Webpage */ ?>

<!-- Utilizes php, html, css, Advanced Custom Fields, bootstrap. 
Stripped down the code and am providing snippets. -->

<?php get_header(); ?>

<header class="position-relative">
	<div class="container pb-5 pb-lg-0">
		<div class="row py-3 py-lg-5">
			<div class="col-xxl-7 d-flex align-items-center pe-2 pe-lg-5">
				<div class="pt-4 py-lg-5 mb-0 mb-lg-4">
					<h1 class="h4 mb-0"><?php the_title();?></h1>
					<h2 class="h1 pb-lg-1 pb-xl-3"><?php the_field('description_title'); ?></h2>
					<div class="pb-lg-2"><?php the_field('hero_copy'); ?></div>
					<?php $hero_button = get_field('button_link_&_title'); ?>
					<a href="<?php echo $hero_button['url']; ?>" class="btn btn-success" target="<?php echo $hero_button['target']; ?>"><?php echo $hero_button['title']; ?></a>
				</div>
			</div>
			<div class="col-xxl-5 d-flex align-items-end justify-content-center mt-4 mt-lg-0">
				<div>
					<img style="max-width: 581px;" class="w-100" src="<?php echo get_template_directory_uri(); ?>/img/hero-img.png" alt="Hero image seo keywords">
				</div>
			</div>
		</div>
	</div>
	<div class="position-absolute bottom-0 w-100">
		<div class="text-end"><svg width="328" height="75" xmlns="http://www.w3.org/2000/svg"><path d="M328 76V.03h-50.69V0H119.487C94.172 0 71.09 14.562 60.019 37.483l-.483 1.034C48.464 61.438 25.285 76 0 76h328Z" fill="#000" fill-rule="evenodd"/></svg></div>
		<div class="bg-dark w-100" style="height: 58px;"></div>
	</div>
</header>

<section class="container-fluid px-0 overflow-hidden mb-1">
	<div class="row">
		<div class="col gy-1">
			<div class="text-bg-dark horizontal-box-bg horizontal-box-bg--r" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/background-img.jpg');">
				<div class="horizontal-box-bg__shadow">
					<div class="container">
						<div class="row justify-content-between py-5">
							<div class="col-lg-4 text-lg-center">
							</div>
							<div class="col-lg-6 col-xl-5 col-xxl-4 my-3">
								<?php if( have_rows('section_1_title_copy_list') ): ?>
								<?php while( have_rows('section_1_title_copy_list') ): the_row();?>
								<h3><?php the_sub_field('title');?></h3>
								<div class="mb-0"><?php the_sub_field('copy');?></div>
								<?php if( have_rows('list_items') ): ?>
									<ul class="list-checks mb-0">
										<?php while( have_rows('list_items') ): the_row();?>
										<li><?php the_sub_field('list_item');?></li>
										<?php endwhile; ?>
									</ul>
								<?php endif; endwhile; endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col gy-1">
			<div class="text-bg-dark horizontal-box-bg horizontal-box-bg--l" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/background-img.jpg');">
				<div class="horizontal-box-bg__shadow">
					<div class="container">
						<div class="row justify-content-between py-5">
							<div class="col-lg-4 order-lg-2 text-lg-center">
							</div>
							<div class="col-lg-6 col-xl-5 my-3 order-lg-1">
								<?php if( have_rows('section_2_title_copy_list') ): ?>
								<?php while( have_rows('section_2_title_copy_list') ): the_row();?>
								<h3><?php the_sub_field('title');?></h3>
								<div class="mb-0"><?php the_sub_field('copy');?></div>
								<?php if( have_rows('list_items') ): ?>
									<ul class="list-checks mb-0">
										<?php while( have_rows('list_items') ): the_row();?>
										<li><?php the_sub_field('list_item');?></li>
										<?php endwhile; ?>
									</ul>
								<?php endif; endwhile; endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="text-bg-dark">
	<div class="container pb-5">
		<div class="row justify-content-center">
			<div class="col-lg-9 pb-4 pt-5 mt-2 mt-md-4 mt-xl-5">
				<h2 class="text-center"><?php the_field('icon_section_title'); ?></h2>
			</div>
		</div>
		<div class="row">
			<?php if( have_rows('icons_&_info') ):
			while( have_rows('icons_&_info') ) : the_row(); 
				$icon = get_sub_field('icon');
				$i_title = get_sub_field('icon_title');
				$i_copy = get_sub_field('icon_copy');
			?>
			<div class="col-md-6 col-lg-4 text-center py-3 pt-lg-5 pb-lg-4">
				<img class="img-fluid mb-2" src="<?php echo $icon['url']; ?>" alt="<?php echo $icon['alt']; ?>">
				<h4><?php echo $i_title; ?></h4>
				<div><?php echo $i_copy; ?></div>
			</div>
			<?php endwhile; endif; ?>
		</div>
		<?php $icon_button = get_field('icon_button_&_link'); 
		if ($icon_button) { ?>
		<div class="row">
			<div class="col text-center mb-4">
				<a href="<?php echo $icon_button['url']; ?>" class="btn btn-success" target="<?php echo $icon_button['target']; ?>"><?php echo $icon_button['title']; ?></a>
			</div>
		</div>
	<?php } ?>
	</div>
</section>

<!-- Video tutorials -->
<section class="container-fluid px-0 overflow-hidden">
	<div class="row">
		<div class="col">
			<div class="bg-light py-3">
				<div class="py-4 py-xl-5">
					<div class="container py-4">
						<div class="row justify-content-center text-center gx-5">
							<div class="col-md-9 col-lg-7">
								<h3 class="h2 mb-3"><?php the_field('tutorial_video_title'); ?></h3>
								<div class="small"><?php the_field('tutorial_video_description'); ?></div>
							</div>
						</div>
						<?php if( have_rows('video_tutorials') ): $i = 0;?>
						<div class="row justify-content-start text-center">

							<?php while( have_rows('video_tutorials') ) : the_row();
								$i++; 
								$v_title = get_sub_field('video_title');
								$v_embed = get_sub_field('youtube_url');
								$v_field = get_sub_field('basic_or_premium_tutorial');
								$v_value = $v_field['value'];
								preg_match('/src="(.+?)"/', $v_embed, $matches);
								$v_src = $matches[1]; ?>

								<?php preg_match('/src="(.+?)"/', $v_embed, $matches_url );
								$src = $matches_url[1];
								preg_match('/embed(.*?)?feature/', $src, $matches_id );
								$id = $matches_id[1];
								$id = str_replace( str_split( '?/' ), '', $id ); ?>

							<?php if( $i < 7 ): ?>
								
							<div class="col-md-6 pt-3 pt-lg-4">
								<div class="row">
									<div class="col-lg-6">
										<div class="container">
											<div class="row text-center text-md-start">
												<div class="col-12 px-0">
													<button type="button" class="border-0 video-btn bg-transparent px-0" data-bs-toggle="modal" data-src="<?php echo strtr($v_src, array('?feature=oembed' => '')); ?>" data-bs-target="#videoModal">
														<div class="card border-0 rounded-0 bg-white">
															<div class="card-img rounded-0 overflow-hidden bg-dark">
															<img src="https://img.youtube.com/vi/<?php echo $id; ?>/mqdefault.jpg" class="img-fluid w-100 opacity-75" alt="Video preview" />
															</div>
															<div class="position-absolute top-50 start-50 translate-middle">
																<img class="play-btn img-fluid" src="<?php echo get_template_directory_uri() ?>/img/play-btn.svg" alt="play button">
															</div>
															<?php if ($v_value == 'premium' ) { ?>
															<div class="position-absolute translate-middle" style="left: 2.75rem; top: 1.5rem;">
																<div class="text-dark px-2" style="background-color: #FFD700; border-radius: 4px; box-shadow: 0 2px 9px rgba(0,0,0,0.25);"><small><strong>Premium</strong></small></div>
															</div><?php }?>
														</div>
													</button>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-6">
										<div class="py-2 text-center text-md-start">
											<h6 class="ff-maven fs-6 fw-bold text-secondary text-uppercase mb-0">Tutorial</h6>
											<h5 class="h4"><?php echo $v_title; ?></h5>
											<button href="#" class="btn btn-outline-dark video-btn mb-4 mb-lg-0" data-bs-toggle="modal" data-src="<?php echo strtr($v_src, array('?feature=oembed' => '')); ?>" data-bs-target="#videoModal">View Video</button>
										</div>
									</div>
								</div>
							</div>
							<?php endif; endwhile; ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php include('documents-articles.php'); ?>

<!-- Video modal -->
<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></span>
				</button>
				<div class="ratio ratio-16x9">
					<iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay" allow="encrypted-media"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>