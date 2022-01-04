<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
						<h4 class="title">Data Email</h4>
						<button  class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#insertemail">
							Add Data<span class="glyphicon glyphicon-plus"></span>
    					</button> 		
                    </div>
                    
	<script>
    $(document).ready( function () {
		$('#table_id').DataTable();
            
	  });
  	</script>
	<div class="content table-responsive table-full-width">
	<table class="table table-striped" id="table_id" >
     <thead>
      <tr>
	  <?php if($user['role_id'] == 1) { ?>
	  <th scope="col"></th>
	  <th scope="col"></th>
	  <?php } ?>
	  <th scope="col">No.</th>
      <th scope="col">Email</th>
      <th scope="col">password</th>
      <th scope="col">Email Recovery</th>
      </tr>
     </thead>
     <tbody>
	   
	   <?php 
	   $number=1;
	   foreach($email as $row ) : 
	  
	   ?>
	   <tr>	
	   		<?php if($user['role_id'] == 1) { ?>
			<td><a class="btn btn-xs btn-info" data-toggle="modal" data-target="#edit_email<?php echo $row['id_email'];?>"> Edit</a></td>
			<td><a class="btn btn-xs btn-info" href="dataemail/delete_email?idEmail=<?php echo $row['id_email'];?>">Delete<a></td>
			<?php } ?>
	        <td><?php echo $number; ?> </td>
			<td><?php echo $row['name_email']; ?> </td>
            <td><?php echo $row['password']; ?> </td>
            <td><?php echo $row['email_recovery']; ?> </td>
	   </tr>
	  <?php 
	  $number++;
	  endforeach; ?>
	 </tbody>
	</table>
	
  </div>
 </div>
 </div>
 </div>
 </div>
 </div>


<!-- Modal Insert-->
<div class="modal fade" id="insertemail" tabindex="-1" role="dialog" aria-labelledby="ModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Data </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
      </div>
      <div class="modal-body">
      <form id="form-insert" method="POST" action="<?php echo base_url('dataemail/insertEmail')?>">
			<div class="form-group row">
				<label  class="col-sm-2 col-form-label"> Email </label>
			<div class="col-sm-10">
				<input type="text" class="form-control" placeholder="E-mail" name="name_email">
			</div>
			</div>
			<div class="form-group row">
				<label  class="col-sm-2 col-form-label">Password</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Password" name="password">
			</div>
            </div>
            <div class="form-group row">
				<label  class="col-sm-2 col-form-label">Email Recovery</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Email Recovery" name="email_recovery">
			</div>
			</div>	
			
	  <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="btn-insert">Insert Data</button>
      </div>
			
	  	</form>
      </div>
     
    </div>
  </div>
</div>


<!-- Modal Edit Email-->
<?php
        foreach($email as $rows ) : 
          
 ?>
<div class="modal fade" id="edit_email<?php echo $rows['id_email'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Data </h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
      </div>
      <div class="modal-body">
      			<form method="POST" action="<?php echo base_url('/dataemail/update_email');?>">
					<div class="form-group row">
						<label  class="col-sm-2 col-form-label">Email / Account</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" value="<?php echo $rows['name_email'];?>" name="name_email" >
					</div>
					</div>
					<div class="form-group row">
						<label  class="col-sm-2 col-form-label">Password</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" value="<?php echo $rows['password'];?>" name="password" >
					</div>
					</div>

					<div class="form-group row">
						<label  class="col-sm-2 col-form-label">Email Recovery</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" value="<?php echo $rows['email_recovery'];?>" name="email_recovery" >
					</div>
					</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<input type="hidden" class="form-control" value="<?php echo $rows['id_email'];?>" name="idEmail">
                    <button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			    </form>
      </div>
     
    </div>
  </div>
</div>
<?php endforeach; ?>


