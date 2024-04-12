<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>
<div class="container page-404__container"   data-aos="fade-up">
				<h1 class="page-404__title">404</h1>
				<div class="page-404__content">
					<div class="page-404__desc">Страница не найдена</div>
					<div class="page-404__text">Но, вы можете вернуться на <a class="page-404__link" href="/">главную </a>или посмотреть популярные категории.</div>
					<ul class="page-404__buttons">
						<?php
					$categories = get_terms( 
										'category', 
										array(
										'parent' => 0,
										'hide_empty'=>0,
										'exclude'=>array('1'),
										)
									 );
									 foreach($categories as $cat){?>
									 <li class="page-404__button"><a class="tag" href="<?php echo(get_category_link($cat->term_id));?>">
										<div class="tag__button tag__button--404"><?php echo($cat->name);?></div>
										</a></li>
									 <?php } ?>
					</ul>
				</div>
			</div>

<?php
get_footer();
