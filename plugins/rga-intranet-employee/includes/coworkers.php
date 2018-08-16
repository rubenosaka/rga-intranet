<?php


  function coworkers($id, $employee){

    $args  = array(
    	'numberposts'	=> 3,
    	'post_type'		=> 'employees',
      'post__not_in' => array($employee)
    );
    $the_query = new WP_Query( $args );
    //print_r($the_query);
  if( $the_query->have_posts() ):
    ?>
    <section id="company-blog" class="col-lg-6 columna">
  			<div class="closeBoton"><i class="fa fa-times-circle-o" aria-hidden="true"></i></div>
  			<h3><i class="fa fa-newspaper-o" aria-hidden="true"></i> News</h3>
  			<div class="borderBox">
  					<div class="row">

    <?php
    while( $the_query->have_posts() ) : $the_query->the_post();


    		?>
        <article data-cu="<?php echo $employee; ?>" data-employee="<?php echo get_the_ID(); ?>" class="col-lg-4 employee employee-<?php echo get_the_ID(); ?>">
          <div class="imgNews">
            <a class="avatar-med" href="<?php the_permalink(); ?>" style="background-image:url(<?php echo get_field('avatar'); ?>);"></a>
          </div>
          <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          <div class="actions">
            <a href="" class="friendship"><i class="fa fa-bookmark-o" aria-hidden="true"></i></a>

            <a href="" class="talk"><i class="fa fa-comments-o" aria-hidden="true"></i></a>
          </div>
        </article>

    	<?php endwhile;

    endif;

    wp_reset_query();
    ?>

        </div>
        <div class="row">
          <div class="col-lg-12 right">
            <a href="">Todas las noticias</a>
          </div>
        </div>
      </div>
    </section>

    <?php
  }



/**
*
* AJAX EMPLOYEES CALLS
*
**/

function test_function() {
      $cu_id = $_GET['cu_id'];
      $id = $_GET['id'];
      echo  $cu_id;
      echo  $id;

      update_field('my_friends', array($id), $id);
   }
add_action( 'wp_ajax_nopriv_test_function',  'test_function' );
add_action( 'wp_ajax_test_function','test_function' );
