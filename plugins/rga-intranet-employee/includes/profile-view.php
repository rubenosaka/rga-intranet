<?php

/* CURRENT USER DATA */
$user =  wp_get_current_user();

print_r($user);

$name = $user->user_login;
$email = $user->user_email;
$avatar = '';

?>
<section id="employee_info">
  <h2><?php echo $name; ?> Profile</h2>

  <ul>
    <?php if($email){ ?>
      <li><strong>Email: </strong><?php echo $email; ?></li>
    <?php } ?>
  </ul>
</section>
<?php

/* EPLOYEE TASKS */

if(function_exists('tasks_post_type')){
  ?>

  <section id="employee-tasks" class="">
    <h4>Assigned tasks</h4>
    <?php
    $args_task = array(
      'post_type' => 'tasks'
    );
    ?>
  </section>
  <?php

}
