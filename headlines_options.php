<?php
/* ====================================================
 * MENU AND OPTIONS PAGE 
 * ==================================================== */
function iterative_add_admin_menu(  ) { 
	//add_options_page( 'Iterative Headlines', '<span style="color: #FF303A; font-weight:bold;">iterative&trade;</span> Headlines', 'manage_options', 'headlines', 'iterative_options_page' );
	add_options_page( ITERATIVE_HEADLINES_BRANDING, ITERATIVE_HEADLINES_BRANDING, 'manage_options', 'headlines', 'iterative_options_page' );
}
// boss mode top/bottom, boss mode has background, boss mode vary text, premium / recommended buttons exist/don't exist, go premium button obnoxious/not obnoxious, top text

function iterative_settings_init(  ) { 

	register_setting( 'iterative_headlines', 'iterative_settings' );

	$options = get_option( 'iterative_settings' );

	add_settings_section(
		'iterative_headlines_section', 
		__( 'Basic Settings', 'wordpress' ), 
		'iterative_settings_section_callback', 
		'iterative_headlines'
	);

/*
	add_settings_field( 
		'iterative_checkbox_enabled', 
		__( 'Headline Testing', 'wordpress' ), 
		'iterative_checkbox_enabled_render', 
		'iterative_headlines', 
		'iterative_headlines_section' 
	);
*/

	add_settings_field( 
		'iterative_radio_goal', 
		__( 'What is your goal in testing your headlines?', 'wordpress' ), 
		'iterative_radio_goal_render', 
		'iterative_headlines', 
		'iterative_headlines_section' 
	);

	if(!isset($options['headlines']['no_premium']) || $options['headlines']['no_premium'] == 0) {
		add_settings_field( 
			'iterative_seo_integration', 
			__( 'Search Engine Integration', 'wordpress' ), 
			'iterative_seo_integration_render', 
			'iterative_headlines', 
			'iterative_headlines_section' 
		);


		add_settings_field( 
			'iterative_sm_integration', 
			__( 'Social Media Integration', 'wordpress' ), 
			'iterative_sm_integration_render', 
			'iterative_headlines', 
			'iterative_headlines_section' 
		);
	}



//	add_settings_field(
//		'iterative_
}


function iterative_checkbox_enabled_render(  ) { 

	$options = get_option( 'iterative_settings' );
	?>
	<label>
		<input type='checkbox' name='iterative_settings[headlines][testing]' <?php checked( isset($options['headlines']['testing']) ? $options['headlines']['testing'] : 1, 1 ); ?> value='1'> 
		Enable testing of my post titles (headlines).
		<p class='description'>It is up to you to define multiple possible headlines to test on each post.<br /> If you do not, this setting will have no effect on posts with only one headline.</p>
	</label>
	<?php

}




function iterative_seo_integration_render(  ) { 

	$options = get_option( 'iterative_settings' );
	?>
	<label class='disabled' onclick='premiumClick("seo");'>
		<input type='checkbox' disabled name='iterative_settings[headlines][seo]' <?php checked( isset($options['headlines']['seo']) ? $options['headlines']['seo'] : 1, 0 ); ?> value='1'> 
		Test headlines specifically for search engines such as Google and Bing. <small class='premium'>Premium</small>
		<p class='description disabled'>Enable this to have the plugin integrate with Google and Bing to test headlines in the search engine, testing to find the best headline specifically for search result clicks.</p>
	</label>
	<?php

}

function iterative_sm_integration_render(  ) { 

	$options = get_option( 'iterative_settings' );
	?>
	<label class='disabled' onclick='premiumClick("sm");'>
		<input type='checkbox' disabled name='iterative_settings[headlines][sm]' <?php checked( isset($options['headlines']['sm']) ? $options['headlines']['sm'] : 1, 0 ); ?> value='1'> 
		Test headlines specifically for social media such as Facebook or Pinterest. <small class='premium'>Premium</small>
		<p class='description disabled'>Enable this to have the plugin integrate with Facebook, Twitter and Pinterest to use the headline which attracts the most clicks and shares on social media sites.</p>
	</label>
	<?php

}




function iterative_radio_goal_render(  ) { 
	// set the text here up for testing.

	$options = get_option( 'iterative_settings' );
	if(!isset($options['headlines'])) {
		$options['headlines'] = array();
	}
	if(!isset($options['headlines']['goal']))
		$options['headlines']['goal'] = ITERATIVE_GOAL_CLICKS;;
	?>
	
	<script type='text/javascript'>
	function premiumClick(id) {
		//if(id == 2 || id == 8) {
		//	
		//	alert(jQuery("<div/>").html("Thanks for your interest. This feature will be available in a future version of <?php echo ITERATIVE_HEADLINES_BRANDING; ?>.").text())
		//} else {
			window.open("http://viralheadlines.com/?source=free&id=" + id);
		//}
	}
	</script>


	<?php 
		if(!isset($options['headlines']['no_premium']) || $options['headlines']['no_premium'] == 0) {
	?>
	<div class='super-feature' onclick='premiumClick(<?php echo ITERATIVE_GOAL_VIRALITY; ?>);'>
		<p><label class='disabled'><input disabled type='radio' class='headline-goal' name='iterative_settings[headlines][goal]' <?php checked( $options['headlines']['goal'], ITERATIVE_GOAL_VIRALITY ); ?> value='<?php echo ITERATIVE_GOAL_VIRALITY; ?>'> I want my posts to go viral! <strong>Please get me more shares, links, readers and clicks!</strong> <small class="recommended">Recommended</small> </label></p>
		<p class='premium-description description'>This premium feature takes Viral Headlines to the next level. We integrate user-specific learning with social sites like Facebook and Twitter as well as search engines like Google and Bing to bring loads of visitors to your site. With this mode, we can show a different ideal headline to a 24-year-old male from California than a 16-year-old iPhone viewer in Canada. <!--<strong>On your site so far, we've calculated that this could have been <u>94%</u> better.</strong>--></p>
	</div>	
	<?php } ?>	
	<p><label><input type='radio' class='headline-goal' name='iterative_settings[headlines][goal]' <?php checked( $options['headlines']['goal'], ITERATIVE_GOAL_CLICKS ); ?> value='<?php echo ITERATIVE_GOAL_CLICKS; ?>'> I want more of my readers to read my posts.</label></p>
	<p class='description headline-goal-description'>We will optimize your headlines to increase the number of users who click through from other pages on your site.</p>
	<p><label><input type='radio' class='headline-goal' name='iterative_settings[headlines][goal]' <?php checked( $options['headlines']['goal'], ITERATIVE_GOAL_COMMENTS ); ?> value='<?php echo ITERATIVE_GOAL_COMMENTS; ?>'> I want my readers to comment on my posts.</label></p>
	<p class='hidden description headline-goal-description'>We will optimize your headlines to pick the headline that attracts the most comments.</p>
	

	<?php 
		if(!isset($options['headlines']['no_premium']) || $options['headlines']['no_premium'] == 0) {
	?>
	<p onclick='premiumClick(<?php echo ITERATIVE_GOAL_TIMEONSITE; ?>);'><label class='disabled'><input type='radio' name='iterative_settings[headlines][goal]' <?php checked( $options['headlines']['goal'], ITERATIVE_GOAL_TIMEONSITE ); ?> disabled value='<?php echo ITERATIVE_GOAL_TIMEONSITE; ?>'> I want my readers to stay longer on my site. <small class='premium'>Premium</small></label></p>
	<p class='hidden description'>This will optimize your headlines for time on site &mdash; we will try to pick the headlines that cause users to stay on your site longer after they see them.</p>
	<!--<p><label><input type='radio' name='iterative_settings[headlines][goal]' <?php checked( $options['headlines']['goal'], 3 ); ?> value='3'> Having my viewers finish reading my posts.</label></p>-->
	<!--<p onclick='premiumClick(<?php echo ITERATIVE_GOAL_ADCLICKS; ?>);'><label class='disabled'><input type='radio' name='iterative_settings[headlines][goal]' <?php checked( $options['headlines']['goal'], ITERATIVE_GOAL_ADCLICKS  ); ?> disabled value='<?php echo ITERATIVE_GOAL_ADCLICKS; ?>'> I want to increase my advertising revenue. <small class='premium'>Premium</small></label></p>-->
	<p onclick='premiumClick(<?php echo ITERATIVE_GOAL_RETURN; ?>);'><label class='disabled'><input type='radio' name='iterative_settings[headlines][goal]' <?php checked( $options['headlines']['goal'], ITERATIVE_GOAL_RETURN ); ?> disabled value='<?php echo ITERATIVE_GOAL_RETURN; ?>'> I want to increase return visits to my site. <small class='premium'>Premium</small></label></p>
<!--	<p onclick='premiumClick(<?php echo ITERATIVE_GOAL_SCROLL; ?>);'><label class='disabled'><input type='radio' name='iterative_settings[headlines][goal]' <?php checked( $options['headlines']['goal'], ITERATIVE_GOAL_SCROLL ); ?> disabled value='<?php echo ITERATIVE_GOAL_SCROLL; ?>'> I want users to <em>actually read</em> my articles. <small class='premium'>Premium</small></label></p>-->
	<!--<p onclick='premiumClick(7);'><label class='disabled'><input type='radio' name='iterative_settings[headlines][goal]' <?php checked( $options['headlines']['goal'], 7 ); ?> disabled value='7'> I want my readers to be more satisfied with my articles. <small class='premium'>Premium</small></label></p>-->
	<!--<p onclick='premiumClick(8);'><label class='disabled'><input type='radio' name='iterative_settings[headlines][goal]' <?php checked( $options['headlines']['goal'], 8 ); ?> disabled value='8'> I have more advanced needs. <small class='premium'>Premium</small></label></p>-->


	<p>
		<br />
		<label class='disabled'>
			<input type='checkbox' name='iterative_settings[headlines][testing]' disabled value='1'> 
			Allow overriding goals on a per-post basis.  <small class='premium'>Premium</small>
			<p class='description disabled'>This will allow you or your authors to select a goal for each post. If this is disabled, only the sitewide goal will be used.</p>
		</label>
	</p>
	<?php
	}
}



function iterative_settings_section_callback(  ) { 
	/*echo __( 'The configuration for this plugin determines whether posts are tested and what the goal is. You should configure the experiments themselves on the individual post page. Please note each user sees only one variant (so from any individual perspective, there will be no test, just one headline shown!)
		<p><span class="iterative">iterative</span>&trade; Headlines is developed in Canada by Iterative Research Inc. and uses our own proprietary blend of <strong>state-of-the-art artificial intelligence</strong> discovered by researchers at Stanford, Princeton, the University of Chicago and the University of British Columbia. By using this cutting edge science, we can deliver rapid and accurate experiment results on even lower traffic websites, much faster than other testing platforms.</p>
		', 'wordpress' );*/
	echo __( 'The configuration for this plugin determines whether posts are tested and what the goal is. You should configure the experiments themselves on the individual post page. Please note each user sees only one variant (so from any individual perspective, there will be no test, just one headline shown!)
		<p>' . ITERATIVE_HEADLINES_BRANDING . ' is developed in Canada by Iterative Research and uses our own proprietary blend of <strong>state-of-the-art artificial intelligence</strong> discovered by researchers at Stanford, Princeton, the University of Chicago and the University of British Columbia. By using this cutting edge science, we can deliver rapid and accurate experiment results on even lower traffic websites, much faster than other testing platforms.</p>
		', 'wordpress' );


	// no demo or science page ready yet / <!--<table width="100%" class="cta-top"><tr><td>Want to know more? <a href="#">Click here to see a demo.</a></td> <td align="right">Would you like to receive emails about statistical web optimization? <a href="#">Sign up for our mailing list.</a></td></tr></table>-->
}


function iterative_options_page(  ) { 

	?>
	<style type='text/css'>
		label.disabled, p.disabled {  color:#999 !important; }
		.cta-top, .cta-top tr, .cta-top tr td { margin:0; padding:0; }
		.cta-top { 
			margin-top:1.2em;
		  	background: #d41f28;
		  	text-transform: uppercase;
			border-radius:5px;
		  	font: normal normal bold 12px "Averia Sans Libre", Helvetica, sans-serif;
		  	padding:3px;
		  	color:white;
		  	text-shadow: 0 1px 1px rgba(0,0,0,0.498039) ;
		}
		.cta-top a { color:white; }
		.cta-top a:hover { text-shadow:0 1px 8px rgba(0,0,0,0.498039) ;; }
		.notyet,.premium,.recommended {
			border-radius:5px;
			font: normal normal bold 12px "Averia Sans Libre", Helvetica, sans-serif;
			padding:3px;
			padding-left:5px;
			padding-right:5px;

			margin-left:5px;
			color: rgb(255, 255, 255);
			text-align: center;
			text-transform: uppercase;
		  
			background: -webkit-linear-gradient(-90deg, rgb(253,218,134) 0, rgb(225,157,60) 100%), rgb(253, 218, 134);
			background: -moz-linear-gradient(180deg, rgb(253,218,134) 0, rgb(225,157,60) 100%), rgb(253, 218, 134);
			background: linear-gradient(180deg, rgb(253,218,134) 0, rgb(225,157,60) 100%), rgb(253, 218, 134);
			text-shadow: 0 1px 1px rgba(0,0,0,0.498039) ;
		}
		.notyet {
			background: -webkit-linear-gradient(-90deg, rgb(218,218,218) 0, rgb(157,157,157) 100%), rgb(218, 218, 218);
			background: -moz-linear-gradient(180deg, rgb(218,218,218) 0, rgb(157,157,157) 100%), rgb(218,218,218);
			background: linear-gradient(180deg, rgb(218,218,218) 0, rgb(157,157,157) 100%), rgb(218,218,218);
		}
		.recommended {
			background: -webkit-linear-gradient(180deg, rgb(23, 204, 8) 0, rgb(9, 119, 26) 100%), rgb(27, 169, 48);
			background: -moz-linear-gradient(180deg, rgb(23, 204, 8) 0, rgb(9, 119, 26) 100%), rgb(27, 169, 48);
			background: linear-gradient(180deg, rgb(23, 204, 8) 0, rgb(9, 119, 26) 100%), rgb(27, 169, 48);
		}
		.iterative { color: #d41f28; font-weight:bold; font-family:Helvetica, arial, sans; }
		#iterative-branding {
			float: right;
			display:block;
			padding: 10px;
			position: absolute;
			bottom: 36px;
			right: 30px;
			z-index: 1;
			width:16px;
		}
		#iterative-branding img { width:100%; }
		.super-feature { 
			padding:5px;
			padding-left:10px;
			padding-right:10px;
			padding-bottom:10px;
			background: rgb(253,218,134);
			border-radius:5px;
			cursor:pointer;
		}
		.super-feature label { color:#333 !important; }
		.super-feature p { color:#555; }
	</style>	
	<div class='wrap'>
		<!--<h2><span class='iterative'>iterative</span>&trade; Headlines</h2>-->
		<h2><?php echo ITERATIVE_HEADLINES_BRANDING; ?></h2>

		<form action='options.php' method='post' id='iterativeform'>
			<?php
			settings_fields( 'iterative_headlines' );
			do_settings_sections( 'iterative_headlines' );
			?>

			<br />
			<div <?php
			$options = get_option("iterative_settings");
			if(isset($options['headlines']['no_premium']) && isset($options['headlines']['no_premium']) == 1) {
				echo "class='super-feature'";
			}
			?> style='float:right;'><label class=''>
			<input id='hide_all' type='checkbox' name='iterative_settings[headlines][no_premium]'  <?php checked( isset($options['headlines']['no_premium']) ? $options['headlines']['no_premium'] : 0, 1 ); ?>  value='1'> 
				Hide all premium features.
			</label></div>
			<?php
			if(isset($options['headlines']['no_premium']) && isset($options['headlines']['no_premium']) == 1) {
				?><script type='text/javascript'>jQuery(function() { 
					jQuery('#hide_all').change(function() { 
						if(!jQuery(this).is(":checked")) {
							jQuery("#submit").click();	
						}
					})
				})</script><?php
			}
			?>
				<input type="hidden" name="iterative_settings[headlines][guid]" value="<?php echo $options['headlines']['guid']; ?>" />
	
			<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"  />
			<input type='button' title="Support the development of sophisticated statistical testing tools by signing up for the <?php echo ITERATIVE_HEADLINES_BRANDING; ?> Pro and start running unlimited tests, optimizing your site for more profitable advertising, mailing list signups and other criteria." onclick='location.href="http://viralheadlines.com/?source=free";' value='Go Premium' class='button premium-button' />
		</form>
		<br />
		<p class='description' title="Don't worry! If the optimization service goes offline, your headlines will continue to work fine."><strong>Optimization Service Status</strong>: <?php
			try { 
				$a = @file_get_contents(IterativeAPI::getEndpoint());
				if($a === false) {
					echo "Temporarily unreachable. Don't worry though, your headlines will continue to work fine.";
				} else {
					if(floatval($a) < 5)
						echo "Very Healthy";
					else if(floatval($a) < 12)
						echo "Healthy";
					else
						echo "Functional";
				}
			} catch(Exception $e) {
				echo "Unknown";
			}
		?></p>
		<a href="http://iterative.ca/" id='iterative-branding'><img src='<?php echo plugins_url("iterativei.png", __FILE__); ?>' /></a>

		
		<script type="text/javascript">
			jQuery(function() {
				var updateGoalSubtexts = function() {
					jQuery(".headline-goal-description").addClass("hidden");
					jQuery(".headline-goal:checked").parent().parent().next(".headline-goal-description").removeClass("hidden");
				};
				jQuery(".headline-goal").change(updateGoalSubtexts);
				updateGoalSubtexts();
			});
		</script>
	</div>
	<?php

}

add_filter("admin_footer_text", "iterative_admin_footer_text");
function iterative_admin_footer_text($in) {
 $in .= '<br /><span id="footer-thankyou">Some icons made by <a href="http://www.flaticon.com/authors/freepik" title="Freepik">Freepik</a> are licensed <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0">CC BY 3.0</a>.</span>';
 return $in;
}

?>
