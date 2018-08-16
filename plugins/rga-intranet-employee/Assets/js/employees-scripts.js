jQuery(document).ready(function(){
  console.log('Init Employees Scripts');

  jQuery('.friendship').on('click', function(e){
    e.preventDefault();
    console.log('lets be friends!');

    var cu = jQuery(this).closest('.employee').attr('data-cu');
    var employee = jQuery(this).closest('.employee').attr('data-employee');
    jQuery(this).find('i').toggleClass('fa-bookmark-o fa-bookmark');

    add_coworker_as_friend(cu, employee);
  });

});

function add_coworker_as_friend(cu_id, id){

    var ajaxurl = 'http://'+window.location.host+'/intranet/wp-admin/admin-ajax.php';

   jQuery.ajax({
   url: ajaxurl,
   type: 'POST',
   data: {action : 'test_function','cu_id': cu_id, 'id' : id  },
     success: function(response) {
     console.log(response);
     console.log("SUCCESS!");
    },
     error: function(data) {
     console.log("FAILURE");

    }
  });
}
