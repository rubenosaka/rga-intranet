jQuery(document).ready(function(){
  jQuery('.friend_btn').on('click', function(e){
    e.preventDefault();

    var if_friend = jQuery(this).attr('data-friend');

    var sel = jQuery(this).closest('.employee');
    var cu = sel.attr('data-cu'),employee = sel.attr('data-employee'), name = sel.attr('data-name'), avatar = sel.attr('data-avatar'), ac;
    jQuery(this).find('i').toggleClass('fa-bookmark-o fa-bookmark');
    if(if_friend == 'true'){
      ac = 'remove';
      jQuery(this).attr('data-friend','false');
    }else{
      ac = 'add';
      jQuery(this).attr('data-friend','true');
    }
    add_coworker_as_friend(cu, employee, name, avatar, ac);
  });

  jQuery('.chat_btn').on('click', function(e){
    e.preventDefault();
    var sel = jQuery(this).closest('.employee');
    var cu_id = sel.attr('data-cu'),ids = sel.attr('data-employee');
    init_conversation(cu_id, ids);

  });

});

function add_coworker_as_friend(cu_id, id, name, avatar, ac){
  var func, html;

  var ajaxurl = 'http://'+window.location.host+'/intranet/wp-admin/admin-ajax.php';
  if (ac == 'add'){
    func = 'add_friend';
    html = '<div class="row"><div class="col-sm-12"><img src="'+avatar+'" class="avatar avatar-sm" />'+name+'<h5>Have just added to your friendship list</h5></div></div>';
  }else{
    func = 'remove_friend';
    html = '<div class="row"><div class="col-sm-12"><img src="'+avatar+'" class="avatar avatar-sm" />'+name+'<h5>Have just removed from your friendship list</h5></div></div>';
  }

   jQuery.ajax({
     url: ajaxurl,
     type: 'POST',
     data: {action : func,'cu_id': cu_id, 'id' : id  },
       success: function(response) {

       push_notification(html, 'success '+func, 'small', 3000);
       //jQuery('.notification_content').html(response);


      },
       error: function(data) {
       console.log("Something goes wrong. Contact with the adeministrator to solve it.");

      }
  });
}

function init_conversation(cu_id, ids){
  console.log(ids);
  acf.do_action('append', jQuery('.modal-content'));
  var ajaxurl = 'http://'+window.location.host+'/intranet/wp-admin/admin-ajax.php';
  jQuery.ajax({
    url: ajaxurl,
    type: 'POST',
    data: {action : 'conversation', 'ids' : ids  },
      success: function(response) {
      acf.do_action('append', jQuery('.modal-content'));  
      jQuery('.modal-content').html(response);
      //jQuery('.notification_content').html(response);


     },
      error: function(data) {
      console.log("Something goes wrong. Contact with the adeministrator to solve it.");

     }
 });

}
