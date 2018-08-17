

jQuery(document).ready(function(){
  jQuery("#push_notification").hide();
});

/**
*
* PUSH NOTIFICATION
*
**/
function push_notification(content, styles, size, dismiss){
  jQuery("#push_notification .notification_content").html(content);

  jQuery("#push_notification").addClass(styles).fadeIn(1000);
  
  if(jQuery.isNumeric(dismiss)){
    setTimeout(function(){ jQuery("#push_notification").fadeOut(1000); }, dismiss);
  }
}
