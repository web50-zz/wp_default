<?php
 /* 
Template Name: Контакты
*/
get_header(); ?>
<section class="contacty">
    <div class="container">
        <div class="contacty__list">
        <?php
                    $args = array(
                    'post_type' => 'contacts',
                    'order'=>'ASC',
                    'orderby'=>'menu_order',
                    'meta_query' => array(
                    )
                    );
                    $res = new WP_Query($args);
                    while($res->have_posts()) :  $res->the_post();
                ?>
            <div class="contacty__list-item" data-aos="fade-up">
                    <div><?the_title()?></div>
                    <div>
                        <a href="tel:<?=get_field('telefon')?>"><?=get_field('telefon')?></a><br>
                        <a class="mail" href="mailto:<?=get_field('e-mail')?>"><?=get_field('e-mail')?></a>
                    </div>
                    <div>
                        <?if(get_field('whatsapp')!=''){?>
                        <a class="contacty__link" href="<?=get_field('whatsapp')?>">
                            <div class="contacty__link-title">Связаться</div>
                            <svg><use href="#wp_icon"></use></svg>
                        </a>
                        <?}?>
                    </div>
            </div>
            <?php endwhile;
            wp_reset_query();
            ?>
        </div>
    </div>
    <div data-aos="fade-left" class="contacty__decor-1"><img src="<?=get_template_directory_uri()?>/assets/images/decors/triangle_contacts-red-blurred.png"/></div>
</section>
<?php get_template_part( 'template-parts/content/contact-form','',array() );?>
<?get_footer();?>