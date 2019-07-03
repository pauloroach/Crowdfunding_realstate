<div id="top-bar" class="top-bar topbar-transparent">
	<div class="container">
		<div class="row">
			<div class="col-md-7 col-sm-7 col-xs-12">
				<ul class="top-info">
					<?php
					if ( defined( 'FW' ) ):
						$top_details = crowdmerc_get_option( 'top_contact_details' );

						foreach ( $top_details as $details ):
							?>
							<li><i class="<?php echo esc_attr( $details[ 'icon' ] ) ?>"></i>
								<p class="info-text"><?php echo esc_html( $details[ 'info' ] ) ?></p>
							</li>
						<?php endforeach;
					endif; ?>
				</ul>
			</div><!--/ Top info end -->

			<div class="col-md-5 col-sm-5 col-xs-12 text-right">
				<ul class="top-social">
					<li>
						<?php
					if ( defined( 'FW' ) ):
						$top_social_details = crowdmerc_get_option( 'top_social_details' );

						foreach ( $top_social_details as $social_details ):
							?>
							<a title="<?php echo esc_attr( $social_details[ 'title' ] ) ?>" href="<?php echo esc_url( $social_details[ 'link' ] ) ?>">
							<span class="social-icon"><i class="<?php echo esc_attr( $social_details[ 'icon' ] ) ?>"></i></span>
						</a>
						<?php endforeach;
					endif; ?>

					</li>
				</ul>
			</div><!--/ Top social end -->
		</div><!--/ Content row end -->
	</div><!--/ Container end -->
</div><!--/ Topbar end -->