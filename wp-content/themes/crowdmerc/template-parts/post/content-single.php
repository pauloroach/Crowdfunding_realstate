<?php
/**
 * content-single.php
 *
 * The default template for displaying single content.
 */
$show_author = crowdmerc_option('show_author', crowdmerc_defaults('show_author'));
$show_social = crowdmerc_option('show_social', crowdmerc_defaults('show_social'));
$show_category = crowdmerc_option('show_category', crowdmerc_defaults('show_category'));
$show_comment = crowdmerc_option('show_comment', crowdmerc_defaults('show_comment'));
$xs_tags = get_the_tags();
$posttags = 0;
if(!empty($xs_tags)){
    foreach ($xs_tags as $xs_tag){
        $posttags++;
    }
}

$pre_post = get_adjacent_post(false, '', true);
$next_post = get_adjacent_post(false, '', false);
?>

<div class="xs-blog-post-details">
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-media post-image">
            <?php the_post_thumbnail( 'post-thumbnail' ); ?>
        </div>
    <?php endif; ?>
    <div class="post-body xs-content-padding xs-style-border">
        <div class="entry-header xs-entry-header-v2 xs-mb-30">
            <div class="post-meta row xs-mb-30 xs-post-meta-list">
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="col-md-2 xs-padding-0 xs-post-meta-date">
                        <span class="post-meta-date xs-navy-blue-bg color-white xs-border-radius"><b><?php echo get_the_date( 'd' ) ?></b> <?php echo get_the_date( 'M' ) ?></span>
                    </div>
                <?php endif; ?>
                <div class="col-md-10 d-flex align-items-end">
                    <?php if($show_category): ?>
                        <span class="post-cat xs-font-alt">
								<i class="fa fa-folder-open"></i><a  href="#"> </a><?php echo get_the_category_list( ', ' );?></a>
							</span>
                    <?php endif; ?>

                    <?php if($show_comment): ?>
                        <span class="post-comment xs-font-alt">
							<i class="fa fa-comments-o"></i>
							<a class="xs-comment" href="#comments"><?php echo get_comments_number(); ?></a>
						</span>
                    <?php endif; ?>

                </div>
            </div>
            <h2 class="entry-title xs-mb-20 xs-post-entry-title"><a class="color-navy-blue bold" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </div>

        <div class="xs-entry-content entry-content xs-mb-40 xs-font-alt">
            <?php the_content( ); ?>
            <?php
            $defaults = array(
                'before'           => '<ul class="fundpress-pagininner">' . esc_html__( 'Pages:', 'crowdmerc' ),
                'after'            => '</ul>',
                'link_before'      => '',
                'link_after'       => '',
                'next_or_number'   => 'number',
                'separator'        => ' ',
                'nextpagelink'     =>esc_html__( '<i class="fa fa-angle-right"></i>', 'crowdmerc'),
                'previouspagelink' =>esc_html__( '<i class="fa fa-angle-left"></i>', 'crowdmerc' ),
                'pagelink'         => '%',
                'echo'             => 1
            );
            crowdmerc_link_pages();
            ?>
        </div>

        <div class="post-footer">
            <?php $xs_width = (class_exists('Xs_Main') && ($show_social)) ? 'w-50' : 'w-100'?>
            <?php if($posttags != 0 || class_exists('Xs_Main') && ($show_social)): ?>
                <div class="xs-single-post-footer xs-post-share-meta border xs-content-padding">
                    <div class="post-tags float-left text-left <?php echo esc_attr($xs_width); ?>">
                        <h5 class="post-footer-sub-heading"><?php echo esc_html__( 'Tags', 'crowdmerc'); ?></h5>
                        <div class="xs-blog-post-tag xs-font-alt">
                            <?php echo get_the_tag_list( ' ' );?>
                        </div>
                    </div><!-- Post tags end -->
                    <?php
                    if(class_exists('Xs_Main') && ($show_social) ):
                        $Xs_Main = Xs_Main::xs_get_instance();
                        $Xs_Main->get_social_share();
                    endif;
                    ?>
                    <div class="clearfix"></div>
                </div>
            <?php endif; ?>
            <?php if($show_author): ?>
                <div class="xs-single-post-footer xs-post-author-meta border xs-content-padding clearfix">
                    <div class="post-meta float-left w-50 text-left">
                        <div class="post-author">
                            <div class="float-left">
                                <div class="xs-avatar fundpress-avatar-big full-round">
                                    <img src="<?php echo get_avatar_url(get_the_author_meta('ID'), 110); ?>" class="img-responsive">
                                </div>
                            </div>
                            <div class="float-right">
                                <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" class="d-block color-navy-blue"><?php the_author(); ?></a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div><!-- post-body end -->
    <div class="xs-single-post-footer xs-post-navigation-meta xs-mt-40">
        <nav class="navigation post-navigation" role="navigation">
            <?php if ( !empty( $pre_post ) ): ?>
                <div class="nav-links w-50 content-left xs-style-border">
                    <a href="<?php echo get_the_permalink( $pre_post->ID ); ?>" rel="prev" class="prev d-inline-block xs-content-padding">
                        <h5><?php echo get_the_title( $pre_post->ID ) ?></h5>
                        <span class="meta-nav"><i class="fa fa-angle-left"></i><?php echo esc_html__('Prev Post','crowdmerc') ?></span>
                    </a>
                </div><!-- .nav-links -->
            <?php endif; ?>
            <?php if ( !empty( $next_post ) ): ?>
                <div class="nav-links w-50 content-right xs-style-border">
                    <a href="<?php echo get_the_permalink( $next_post->ID ); ?>" rel="next" class="next d-inline-block xs-content-padding">
                        <h5><?php echo get_the_title( $next_post->ID ) ?></h5>
                        <span class="meta-nav"><?php echo esc_html__('next Post','crowdmerc') ?><i class="fa fa-angle-right"></i></span>
                    </a>
                </div><!-- .nav-links -->
            <?php endif; ?>
            <div class="clearfix"></div>
        </nav>
    </div>
</div><!-- post end -->