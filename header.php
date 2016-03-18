<?php include_once(dirname(__FILE__) . '/templates/head.php'); ?>
<div class="wrap head">
    <div class="row">
        <div  class="col-sm-10 col-xs-offset-1">
            <header id="header" class="row">
                <div id="logo" class="col-sm-3 col-xs-12">
                    <a href="<?php echo site_url(); ?>" title="<?php bloginfo( 'name' ); ?>">
											<img src="<?php bloginfo( 'template_url' ) ?>/dist/images/logo.png">
										</a>
                </div>
								<div id="menu-holder" class="row">
                    <nav class="navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse navbar-ex1-collapse">
                            <?php
                                wp_nav_menu( array(
                                'menu' => 'hoofdmenu',
                                'depth' => 1,
                                'container' => false,
                                'menu_class' => 'nav navbar-nav',
                                //Process nav menu using our custom nav walker
                                'walker' => new wp_bootstrap_navwalker())
                                );
                            ?>
                        </div>
                    </nav>
                </div><!-- /row-->
                <div class="clearfix visible-xs-block"></div>
            </header>
        </div><!-- / col -->
    </div><!-- /row -->
</div><!-- headwrap -->
