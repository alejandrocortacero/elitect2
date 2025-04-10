<?php defined( 'ABSPATH' ) or die ( 'Wrong Access' ); ?>
<ul class="list-inline">
<?php foreach( $links as $link ) : ?>
<li>
	<a href="<?php echo $link['url']; ?>" rel="<?php echo $link['rel']; ?>">
		<img
			src="<?php echo $link['imgurl']; ?>"
			class="img-responsive"
			alt="<?php echo $link['title']; ?>"
			title="<?php echo $link['title']; ?>"
		/>
	</a>
</li>
<?php endforeach; ?>
</ul>
