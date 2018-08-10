console.log('test');

jQuery(document).ready(function(){
  jQuery("#push_notification").hide();
});


function push_notification(text, styles){
  jQuery("#push_notification .notification_content").html(text);

  jQuery("#push_notification").addClass(styles).fadeIn(1000);
}
