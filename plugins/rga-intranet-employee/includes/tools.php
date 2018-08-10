<?php

function employees_tools_init(){
  echo '<div id="toolsMenu" class="hideMenuLeft"><div class="botonToolMenu"><i class="fa fa-cog" aria-hidden="true"></i></div><div class="contetnToolMenu">';
    $user_id = get_employe_data('ID');

    $options = array(
	     'fields' => array("home_panel"),
       'html_updated_message'	=> '<div id="tools_updated" class="updated hide"><p>%s</p></div>',
       'return' => '?tool_home=true&updated=true'
    );

    $args = array(
    	'numberposts'	=> 1,
    	'post_type'			=> 'employees',
      'meta_key'		=> 'wp_user_id',
  	  'meta_value'	=> $user_id
    );

    $the_query = new WP_Query( $args );

    if( $the_query->have_posts() ):
      while( $the_query->have_posts() ) : $the_query->the_post();
        ?>
        <div class="row">
          <div class="col-sm-12">
            <h4><a href="<?php echo get_site_url(); ?>/profile/"><?php the_title(); ?></a></h4>
          </div>
        </div>

        <?php
        $avatar = get_field('avatar');

        if($avatar){
          ?>
            <div class="row">
              <div class="col-sm-12">
                <a href="<?php echo get_site_url(); ?>/profile/"><img src="<?php echo $avatar; ?>" alt="Avatar de <?php the_title(); ?>" /></a>
              </div>
            </div>
          <?php
        }

        acf_form($options);
      endwhile;
    endif;

    wp_reset_query();

	  echo '</div></div>';
    echo '<script type="text/javascript">jQuery( ".botonToolMenu" ).click(function(){jQuery(".hideMenuLeft").toggleClass("show");jQuery(this).children("i").toggleClass("fa-spin");	});</script>';

    if( isset($_GET['updated']) && $_GET['updated'] == 'true' ) {
      echo '<script type="text/javascript">jQuery(document).ready(function(){ push_notification("<i class=\"fa fa-check\" aria-hidden=\"true\"></i> Options updated successfully","success"); });</script>';
    }


}

 ?>
