<?php
// $Id: page.tpl.php,v 1.1 2010/08/25 21:48:07 geops1 Exp $

/**
 * @file page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the current
 *   path, whether the user is logged in, and so on.
 * - $body_classes_array: An array of the body classes. This is easier to
 *   manipulate then the string in $body_classes.
 * - $node: Full node object. Contains data that may not be safe. This is only
 *   available if the current page is on the node's primary url.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing primary navigation links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links for
 *   the site, if they have been configured.
 *
 * Page content (in order of occurrance in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 *
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the view
 *   and edit tabs when displaying a node).
 *
 * - $content: The main content of the current Drupal page.
 *
 * - $right: The HTML for the right sidebar.
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>">

<head>
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>

  <?php print $scripts; ?>

  <!-- jquery noconflict -->
  <script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/jquery-1.11.3.min.js"></script>
    <script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/remodal.js"></script>
  <script type="text/javascript">
   	var jQuery11 = jQuery.noConflict();
  </script>


   <?php if(($node->type == "show") && ($node->field_audio_path[0]['safe']))  {
    // this is for facebook share -- for more info go to http://developers.facebook.com/docs/share  ?>
    <meta name="title" content="<?php print $node->title; ?>" />
    <?php if($node->field_summary[0]['safe']) { ?>
    <meta name="description" content="<?php print strip_tags($node->field_summary[0]['safe']); ?>" />
    <?php } ?>
    <link rel="image_src" href="<?php print imagecache_create_url("teaser-archive-thumbnail", $node->field_image[0]['filepath']); ?>" />
    <!-- <link rel="audio_src" href="<?php print $artonair_mp3folder_http . "/" . trim($node->field_audio_path[0]['safe']); ?>" /> -->
    <meta name="audio_title" content="<?php print $node->title; ?>" />
    <meta name="audio_artist" content="clocktower.org" />
    <meta name="audio_type" content="Content-Type header field" />
  <?php } ?>
    <meta name="site_name" content="Clocktower Productions & Radio" />
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>


	<!-- cycle -->
	<script type="text/javascript" src="<?php print base_path() . path_to_theme(); ?>/js/jquery.cycle2.min.js"></script>

	<!-- noconflict script -->
	<script type="text/javascript">
		//noconflict below
	jQuery11(document).ready(function($) {
		/*initiate cycle */
		$( '.banner-news' ).cycle({
		    fx : 'scrollHorz',
			slides : '.view-content > div.views-row',
			pauseOnHover : 1,
			swipe : 1,
			prev : "#prev",
        	next : "#next",
		});


//		$('.banner-news').cycle('pause');

	});
	</script>

</head>
<body class="<?php print $body_classes; ?>">

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="twitter-root"></div>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

 	 	<!-- <div id="page-inner"> -->

 	 	    <div id="page">

        <div id="menuLink" class="menu-link">
          <i class="icon icon-list"></i>
        </div>

		   		<?php if ($primary_links || $secondary_links || $navbar): ?>
    			  <div id="skip-to-nav"><a href="#navigation"><?php print t('Skip to Navigation'); ?></a></div>
    			<?php endif; ?>

<div id="nav-bar">
<div id="nav-bar-inner" class="clear-block">
				  <?php if ($logo || $site_name || $site_slogan): ?>
        			<div id="logo-title">
			          <?php if ($logo): ?>
        		    <div id="logo"><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" id="logo-image" /><div class="logo-span"></div></a>
        		    </div><!-- /#logo -->
       				   <?php else: ?>

	          <?php if ($site_name): ?>
    	        <?php if ($title): ?>
              <div id="site-name"><strong>
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
                <?php print $site_name; ?>
                </a>
              </strong></div><!-- /#site-name -->
            <?php else: ?>
              <h1 id="site-name">
                <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
                <?php print $site_name; ?>
                </a>
              </h1>
            <?php endif; ?>
          <?php endif; ?>
<?php endif; ?>
          <?php if ($site_slogan): ?>
            <div id="site-slogan"><?php print $site_slogan; ?></div>
          <?php endif; ?>

        </div> <!-- /#logo-title -->
      <?php endif; ?>

    	<div id="menu">
			<?php
			$tree = menu_tree_page_data('primary-links');
			echo menu_tree_output($tree);
			?>
		</div>

      <?php if ($header): ?>
        <div id="nav-bar-blocks" class="region region-nav-bar">

          <?php print $header; ?>



        </div> <!-- /#header-blocks -->
      <?php endif; ?>

      <?php if ($search_box): ?>
	<div id="search-box">
	  <?php print $search_box; ?>
	</div> <!-- /#search-box -->
      <?php endif; ?>
		<!-- /#header -->

    </div>

</div>
 <div id="page-inner">
    		<div id="header">
				<div id="listen-bar">

        <div id="search-box">
        <form action="/drupal/search"  accept-charset="UTF-8" method="get">
        <div class="submit-button"><input type="image" src="<?php print url(path_to_theme() . '/images/menu_searchbutton.gif'); ?>"  id="edit-submit" value="Search"  class="form-submit" /></div>
         <div class="form-item" id="edit-search-theme-form-1-wrapper">
         <input type="text" maxlength="128" name="keys" id="edit-search-theme-form-1" size="15" placeholder="Search" title="Enter the terms you wish to search for."  class="form-text" />
         </div>

         </form>
         </div>

				</div><!-- /#listen-bar -->

    </div> <!-- /#header -->

    <?php if ($help_area): ?>
    <div id="help_area" class="region region-help_box">
      <?php print $help_area; ?>
    </div> <!-- /#help_area -->
    <?php endif; ?>


    <div id="main">
    <div id="main-inner" class="clear-block<?php if ($search_box || $primary_links || $secondary_links || $navbar) { print ' with-navbar'; } ?>">

      <div id="content">
      <div id="content-inner">


        <?php if ($mission): ?>
          <div id="mission"><?php print $mission; ?></div>
        <?php endif; ?>

        <?php if ($content_top): ?>
          <div id="content-top" class="region region-content_top">
            <?php print $content_top; ?>
          </div> <!-- /#content-top -->
        <?php endif; ?>

        <?php if ($breadcrumb || $title || $tabs || $help || $messages): ?>
          <div id="content-header">
          <?php if(($node->type !== "show") && ($node->type !== "series") && ($node->type !== "partner") && ($node->type !== "person") && ($node->type !== "blog") && ($node->type !== "exhibition") && ($node->type !== "residency") && ($node->type !== "event"))  : ?>
          <h6 class="type radio"><a href="/drupal/radio">Radio</a></h6>
          <h6 class="type projects"><a href="/drupal/projects">Projects</a></h6>
          <h6 class="type about"><a href="/drupal/about">About</a></h6>
          <h6 class="type news"><a href="/drupal/news">News</a></h6>
           <?php endif; ?>
            <?php print $breadcrumb; ?>
            <?php if ($title && $is_front != true) : ?>
              <h1 class="title"><?php print $title; ?></h1>
            <?php endif; ?>
            <?php if($logged_in == TRUE) { print $messages; } ?>
            <?php if ($tabs): ?>
              <div class="tabs"><?php print $tabs; ?></div>
            <?php endif; ?>
            <?php print $help; ?>
          </div> <!-- /#content-header -->
        <?php endif; ?>

        <div id="content-area">
          <?php print $content; ?>
        </div>

        <?php if ($feed_icons): ?>
          <div class="feed-icons"><?php print $feed_icons; ?></div>
        <?php endif; ?>


        <?php if ($content_bottom): ?>
          <div id="content-bottom" class="region region-content_bottom">
            <?php print $content_bottom; ?>
          </div> <!-- /#content-bottom -->
        <?php endif; ?>



      </div></div> <!-- /#content-inner, /#content -->


      <?php if ($primary_links || $secondary_links || $navbar): ?>
        <div id="navbar"><div id="navbar-inner" class="clear-block region region-navbar">

          <a name="navigation" id="navigation"></a>

          <?php if ($primary_links): ?>
            <div id="primary" class="clear-block">
              <?php print theme('links', $primary_links); ?>
            </div> <!-- /#primary -->
          <?php endif; ?>

          <?php if ($secondary_links): ?>
            <div id="secondary" class="clear-block">
              <?php print theme('links', $secondary_links); ?>
            </div> <!-- /#secondary -->
          <?php endif; ?>

          <?php print $navbar; ?>

        </div></div> <!-- /#navbar-inner, /#navbar -->
      <?php endif; ?>

      <?php if ($left): ?>
        <div id="sidebar-left"><div id="sidebar-left-inner" class="region region-left">
          <?php print $left; ?>
        </div></div> <!-- /#sidebar-left-inner, /#sidebar-left -->
      <?php endif; ?>

      <?php if ($right): ?>
        <div id="sidebar-right"><div id="sidebar-right-inner" class="region region-right">
          <?php print $right; ?>
        </div></div> <!-- /#sidebar-right-inner, /#sidebar-right -->
      <?php endif; ?>

 <?php if ($footer || $footer_message): ?>
      <div id="footer"><div id="footer-inner" class="region region-footer">

        <?php if ($footer_message): ?>
          <div id="footer-message"><?php print $footer_message; ?></div>
        <?php endif; ?>

        <?php print $footer; ?>


      </div></div> <!-- /#footer-inner, /#footer -->
    <?php endif; ?>


  </div></div> <!-- /#main-inner, /#main -->




  <?php if ($closure_region): ?>
    <div id="closure-blocks" class="region region-closure">

    	    <div class="inner">


    <?php print $closure_region; ?>
  <?php endif; ?>

  <?php print $closure; ?>

 <div id='toTop'><i class="icon icon-up"></i></div>

  </div> <!-- /#page-inner,  -->
</div> <!--/#page -->

</body>
</html>
