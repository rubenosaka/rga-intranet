<?php



  /**
  *
  * CUSTOM FUCTIONS
  *
  */



  function related_project_tasks(){

      $screen = get_current_screen();

      $project_id =  $_GET['post'];

      $args = array(
        'post_type' => 'tasks',
        'meta_query' => array(
								array(
									'key' => 'related_project',
									'value' => '"' . $project_id . '"',
									'compare' => 'LIKE'
								)
							)
      );


        if( $screen->id =='projects'){

            $the_query = new WP_Query( $args );

            if( $the_query->have_posts() ): ?>
              <div class="wrap">
                <div class="box-related-tasks">
                  <h3>Tasks assigned to this project:</h3>
                <?php
                while( $the_query->have_posts() ) : $the_query->the_post(); ?>
                  <div class="box-related-task">
                    <a href="<?php echo the_permalink(); ?>" alt="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>
                  </div>
                <?php endwhile; ?>
                </div>
              </div>
            <?php
          endif;


       }
   }



    function project_styles() {
      $screen = get_current_screen();


      if( $screen->id =='projects'){
        echo '<style>
          .box-related-tasks{
            width:100%;
            box-sizing:border-box;
            padding-bottom:30px;
            border-bottom:1px solid #CCC;
            margin-bottom:30px;
            float:left;
          }

          .box-related-tasks h3{
            margin-top:0;
            margin-bottom:30px;
          }

          .box-related-task{
            background-color:#FFF;
            width:32%;
            padding:10px;
            box-sizing:border-box;
            float:left;
            border-left:5px solid #6262c0;
            margin-right:1%;
          }
        </style>';
      }
    }
