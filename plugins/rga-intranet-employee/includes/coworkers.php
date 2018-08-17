<?php


  function coworkers($id, $employee){
    $fls = get_field('my_friends', $employee);
    $flf = array();

    foreach ($fls as $fl){$flf[]= $fl->ID;}

    print_r($flf);

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


        if(in_array(get_the_ID(), $flf)){$class = 'friend'; }else{$class = 'coworker';}

    		?>
        <article data-cu="<?php echo $employee; ?>" data-employee="<?php echo get_the_ID(); ?>" data-name="<?php the_title(); ?>" data-avatar="<?php echo get_field('avatar'); ?>" class="col-lg-4 employee employee-<?php echo get_the_ID(); echo ' '.$class;?>">
          <div class="imgNews">
            <a class="avatar-med avatar" href="<?php the_permalink(); ?>" style="background-image:url(<?php echo get_field('avatar'); ?>);"></a>
          </div>
          <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          <div class="actions">
            <?php if(in_array(get_the_ID(), $flf)){ ?>
              <a href="" class="friend_btn" data-friend="true"><i class="fa fa-bookmark" aria-hidden="true"></i></a>
            <?php }else{ ?>
              <a href="" class="friend_btn" data-friend="false"><i class="fa fa-bookmark-o" aria-hidden="false"></i></a>
            <?php } ?>


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
add_action( 'wp_ajax_nopriv_add_friend',  'add_friend' );
add_action( 'wp_ajax_add_friend','add_friend' );

function add_friend() {
      $cu_id = $_POST['cu_id'];
      $id = $_POST['id'];
      $mf = get_field('my_friends', $cu_id);

      if( !is_array($mf) ):
      	$mf = array();
      endif;
      array_push($mf, $id);

      update_field('my_friends', $mf, $cu_id);

      die();
   }

   add_action( 'wp_ajax_nopriv_remove_friend',  'remove_friend' );
   add_action( 'wp_ajax_remove_friend','remove_friend' );

   function remove_friend() {
         $cu_id = $_POST['cu_id'];
         $id = $_POST['id'];
         $fls = get_field('my_friends', $cu_id);

         $flf = array();
         foreach ($fls as $fl){$flf[]= $fl->ID;}
         print_r($flf);
         if (($key = array_search($id, $flf)) !== false) {
           unset($flf[$key]);
         }
         print_r($flf);
         update_field('my_friends', $flf, $cu_id);

         die();
      }
