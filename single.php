<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage LAD
 * @since Twenty Twenty-One 1.0
 */

get_header();?>

<section class="single">
    <div class="container">
        <div class="single-container">
			<div class="left-space">
            </div>
            <div class="single-content">
				<div class="black_header">
					<?the_title()?>
				</div>
	            <div>
                    <?the_content()?>
                </div>
            </div>
        </div>
    </div>
</section>

<?get_footer();?>
