<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="box-body">
  <table class="table table-bordered">
    <tbody>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Number of Guests</th>
        <th>Remove</th>
      </tr>
      <?php foreach($clients as $c): ?>
        <tr>
          <td><?php echo $c->client_id ?></td>
          <td><?php echo $c->first_name; ?> <?php echo $c->last_name; ?></td>
          <td><?php echo $c->number_of_guests ?></td>
          <td><a href="javascript:void(0);" onclick="removeFromEvent('<?php echo base_url(); ?>','<?php echo $c->event_id; ?>','<?php echo $c->client_id ?>')" ><span class="label label-danger"><i title="Remove" class="fa fa-times"></i> Remove</span></a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script type="text/javascript">
function removeFromEvent(url, event_id, client_id){

  $("#add_"+client_id).css("cursor","pointer");
  $("#add_"+client_id).attr("onclick","addClientEventAttendance('"+url+"', '"+event_id+"', '"+client_id+"')");
  $("#add_"+client_id+" span").removeClass("label-info");
  $("#add_"+client_id+" span").addClass("label-success");
  $("#add_"+client_id+" span").html("<i title='Added' class='fa fa-plus'></i> Add");
  
  $("#add_attendees").load(url+"/admin/clientEvent/remove_client_from_event/"+event_id+"-"+client_id).fadeIn("slow");
  $("#display_attendees").load(url+"/admin/clientEvent/get_clients_by_event_id/"+event_id).fadeIn("slow");
  var controller = 'clientEvent';
  var method = 'get_clients_by_event_id';
  reload(url, controller, method, event_id);
}

function reload(url, controller, method, id){
    var $loader = $("#loader");
    if ($loader.is(":visible")) { return; }
    $loader.show();
    setTimeout(function() {
        $loader.hide();
        $("#display_attendees").load(url+"admin/"+controller+"/"+method+"/"+id).fadeIn("slow");
    }, 1000);
}
</script>