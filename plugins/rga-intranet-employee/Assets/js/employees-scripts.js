jQuery(document).ready(function(){

  jQuery('.friend_btn').on('click', function(e){
    e.preventDefault();
    var if_friend = jQuery(this).attr('data-avatar');
    var sel = jQuery(this).closest('.employee');
    var cu = sel.attr('data-cu'),employee = sel.attr('data-employee'), name = sel.attr('data-name'), avatar = sel.attr('data-avatar'), ac;
    jQuery(this).find('i').toggleClass('fa-bookmark-o fa-bookmark');
    if(if_friend == 'true'){
      ac = 'add';
      jQuery(this).attr('data-avatar','false');
    }else{
      ac = 'remove';
      jQuery(this).attr('data-avatar','true');
    }
    add_coworker_as_friend(cu, employee, name, avatar, ac);
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
       jQuery('.notification_content').html(html);
       //jQuery('.notification_content').html(response);
       jQuery('#push_notification').fadeIn();

      },
       error: function(data) {
       console.log("Something goes wrong. Contact with the adeministrator to solve it.");

      }
  });
}