<?php

function birthday_init(){
  
  $posts = get_posts(array(
  	'posts_per_page'	=> -1,
  	'post_type'			=> 'employees',
    'meta_key'		=> 'birthday_date',
	  'meta_value'	=> date('Ymd')
  ));

if( $posts ):
  echo '<div class="alert left birthdays"><div class="closeBoton"><i class="fa fa-times-circle-o" aria-hidden="true"></i></div><h6><i class="fa fa-birthday-cake" aria-hidden="true"></i> Felicita el cumpleaños</h6>';
    echo '<ul>';
      foreach( $posts as $p ):
        echo '<li>Hoy es el cumpleaños de <strong>'.$p->post_title.'</strong></li>';
        $id = $p->ID;
        echo $date;
      endforeach;
    echo '<ul>';
  echo '</div>';
  echo '<script type="text/javascript">jQuery(".birthdays").fadeIn(2000);</script>';
endif;

}
