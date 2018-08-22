<?php

   add_action( 'wp_ajax_nopriv_conversation',  'conversation' );
   add_action( 'wp_ajax_conversation','conversation' );

function conversation(){

  $cu_id = $_POST['cu_id'];
  $ids = $_POST['ids'];


  $options = array(
  'post_id' => 'new_post',
   'html_updated_message'	=> '<div id="tools_updated" class="updated hide"><p>Send Conversation</p></div>',
   'return' => '?msg_send=true&chat=true',
   'fields'=> array('content'),
   'new_post'		=> array(
     'post_type'		=> 'conversations',
     'post_status'		=> 'publish',
   ),
   'html_after_fields' => '<input type="hidden" name="acf[field_5b7a737e2e366]" value="'.$ids.'"/>',
 );




      acf_form($options);



}


 ?>
