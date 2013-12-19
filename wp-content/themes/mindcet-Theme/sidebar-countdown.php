<?php
/**
 * The sidebar containing the footer widget area
 *
 * If no active widgets in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

if ( is_active_sidebar( 'countdown' ) ) : ?>
		<div class="countdown-area">
			<?php dynamic_sidebar( 'countdown' ); ?>
		</div>
<?php endif; ?>