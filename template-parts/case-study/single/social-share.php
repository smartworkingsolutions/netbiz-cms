<?php
/**
 * The template part for displaying social share icons.
 *
 * @package Netbiz
 */

$img_url = '';

if ( has_post_thumbnail() ) {
	$thumbnail_id = get_post_thumbnail_id( get_the_id() );
	$image        = df_resize( $thumbnail_id, '', 600, 400, true, true );
	$img_url      = $image['url'];
}
?>

<a href="//www.facebook.com/share.php?m2w&s=100&p[url]=<?php echo rawurlencode( get_permalink() ); ?>&p[images][0]=<?php echo rawurlencode( $img_url ); ?>&p[title]=<?php echo rawurlencode( get_the_title() ); ?>&u=<?php echo rawurlencode( get_permalink() ); ?>&t=<?php echo rawurlencode( get_the_title() ); ?>" class="text-xl hover:text-theme-color" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fab fa-facebook"></i></a>

<a href="http://pinterest.com/pin/create/button/?url=<?php echo rawurlencode( get_permalink( get_the_id() ) ); ?>&media=<?php echo rawurlencode( $img_url ); ?>&description=<?php get_the_title(); ?>" class="text-xl hover:text-theme-color" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fab fa-pinterest"></i></a>

<a title="Click to share this post on Twitter" href="http://twitter.com/intent/tweet?text=<?php echo rawurlencode( get_the_title() ); ?>&url=<?php echo rawurlencode( get_permalink() ); ?>" class="text-xl hover:text-theme-color" target="_blank" rel="noopener noreferrer"><i class="fa fa-twitter"></i></a>

<a href="//www.linkedin.com/shareArticle?mini=true&url=<?php echo rawurlencode( get_permalink() ); ?>&title=<?php echo rawurlencode( get_the_title() ); ?>&source=<?php echo 'url'; ?>" class="text-xl hover:text-theme-color" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-linkedin"></i></a>
