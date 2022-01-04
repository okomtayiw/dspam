<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
						<h4 class="title">Data Spam</h4>
					<?php if($user['role_id'] == 1) { ?>
					<button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#ModalScrollableInsert">
					Add Data<span class="glyphicon glyphicon-plus"></span>
					</button>
					<button type="button" class="btn btn-secondary btn-sm" id="btn-delete">Multi Delete</button>
					<?php } ?>
					</div>
					<script>
					$(document).ready( function () {
						$('#table_id').DataTable({
							"scrollX": true,
							responsive: true
						});
							
					});
					</script>
                    <div class="content table-responsive table-full-width">
					<form method="post" action="<?php echo base_url('/spam/delete_spam') ?>" id="form-delete-spam">
					<table class="table table-hover table-striped" style="width:100%" id="table_id" >
					<thead>
					<tr>
					<?php if($user['role_id'] == 1) { ?>
					<th scope="col"><input type="checkbox" id="check-all" ></th> 
					<th scope="col">Action</th>
					<?php } ?>
					<th scope="col">No.</th>
					<th scope="col">Email</th>
					<th scope="col">Link Post</th>
					<th scope="col">Date POST</th>
					<th scope="col">Title</th>
					<th scope="col">Status</th>
					<th scope="col">Keterangan</th>
					</tr>
					</thead>
					<tbody>
					
					<?php 
					$number=1;
					foreach($spam as $row ) : 
					
					?>
					<tr>
						<?php if($user['role_id'] == 1) { ?>
							<td><input type="checkbox" class="check-item" name="idSpam[]" value="<?php echo $row['id_spam'];?>" ></td>
							<td><a class="btn btn-xs btn-info" data-toggle="modal" data-target="#edit_spam<?php echo $row['id_spam'];?>"> Edit</a></td>
							<?php } ?>			
							<td><?php echo $number; ?> </td>
							<td><?php echo $row['email']; ?> </td>
							<td><a href="<?php echo $row['link_post']; ?>"><?php echo $row['link_post']; ?></a> </td>
							<td><?php echo $row['tgl_post']; ?></td>
							<td><?php echo $row['title']; ?></td>
							<td><?php echo $row['status']; ?></td>
							<td><?php echo $row['Keterangan']; ?></td>
					</tr>
					<?php 
					$number++;
					endforeach; ?>
					</tbody>
					</table>
					<p><?php //echo $links; ?></p>
					
					</form>
  					</div>
 				</div>
 			</div>
		</div>
	</div>
</div>
<!-- Modal Insert-->
<div class="modal fade" id="ModalScrollableInsert" tabindex="-1" role="dialog" aria-labelledby="ModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Add Data SPAM</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
      </div>
      <div class="modal-body">
      <form id="form-insert" method="POST" action="<?php echo base_url('index.php/spam/insertSpam')?>">
			<div class="form-group row">
				<label  class="col-sm-2 col-form-label"> Email </label>
			<div class="col-sm-10">
			<select name="idEmail">
				<?php 
				foreach ($email as $rowemail) :

				?>
				<option value="<?php echo $rowemail['id_email'];?>"><?php echo $rowemail['name_email'];?></option>
				<?php 
				endforeach;
				?>
            </select>
			</div>
			</div>
			<div class="form-group row">
				<label  class="col-sm-2 col-form-label">Account</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Account" name="account">
			</div>
			</div>
			<div class="form-group row">
				<label  class="col-sm-2 col-form-label">Link POST</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Link Post" name="link_post">
			</div>
			</div>
			<div class="form-group row">
				<label  class="col-sm-2 col-form-label">Title</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Title" name="title">
			</div>
			</div>
			<div class="form-group row">
				<label  class="col-sm-2 col-form-label">Status</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Status" name="status">
			</div>
			</div>
			<div class="form-group row">
				<label  class="col-sm-2 col-form-label">Note</label>
			<div class="col-sm-10">
			<input type="text" class="form-control" placeholder="Keterangan" name="keterangan">
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


<!-- Modal Edit Spam-->
<?php
foreach($spam as $rows ) : 
?>
<div class="modal fade" id="edit_spam<?php echo $rows['id_spam'];?>" tabindex="-1" role="dialog" aria-labelledby="ModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Data Spam</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
      </div>
      <div class="modal-body">
	  <form method="POST" action="<?php echo base_url('/spam/update_spam');?>">
				   <div class="form-group row">
				   <label  class="col-sm-2 col-form-label"> Email </label>
					<div class="col-sm-10">
					<select name="idEmail">
						<?php 
						foreach ($email as $rowemail) :

						?>
						<option value="<?php echo $rowemail['id_email'];?>" <?php if (!(strcmp($rowemail['id_email'], $rows['id_email']))) {echo "selected=\"selected\"";} ?>><?php echo $rowemail['name_email'];?></option>
						<?php 
						endforeach;
						?>
					</select>
					</div>
					</div>
					<div class="form-group row">
						<label  class="col-sm-2 col-form-label">Email / Account</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" value="<?php echo $rows['account'];?>" name="account" >
					</div>
					</div>
					<div class="form-group row">
						<label  class="col-sm-2 col-form-label">LINK POST</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" value="<?php echo $rows['link_post'];?>" name="link_post" >
					</div>
					</div>

					<div class="form-group row">
						<label  class="col-sm-2 col-form-label">TGL POST</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" value="<?php echo $rows['tgl_post'];?>" name="tgl_post" >
					</div>
					</div>

					<div class="form-group row">
						<label  class="col-sm-2 col-form-label">Title</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" value="<?php echo $rows['title'];?>" name="title" >
					</div>
					</div>

					<div class="form-group row">
						<label  class="col-sm-2 col-form-label">Status</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" value="<?php echo $rows['status'];?>" name="status" >
					</div>
					</div>
					
					<div class="form-group row">
						<label  class="col-sm-2 col-form-label">Keterangan</label>
					<div class="col-sm-10">
					<input type="text" class="form-control" value="<?php echo $rows['Keterangan'];?>" name="keterangan" >
					</div>
					</div>
					
					
				
				
				<div class="modal-footer">
				        <input type="hidden" class="form-control" value="<?php echo $rows['id_spam'];?>" name="idSpam">	
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			    </form>
      </div>
     
    </div>
  </div>
</div>
<?php
endforeach;
?>











<!-- Multi DELETE -->
 <script type="text/javascript">
	$(document).ready(function(){
		
		$("#check-all").click(function(){
        if($(this).is(":checked"))
				 $(".check-item").prop("checked", true);
			
		    else
				$(".check-item").prop("checked", false); 
		
			});
	      $("#btn-delete").click(function(){ 
		    			var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data Spam ini?"); 
	  
							if(confirm) 
							$("#form-delete-spam").submit(); 
      	  });
		
		
  $('#ModalScrollableUpdate').on('show.bs.modal','.passingID', function (event) {
  var ids = $(this).attr('data-id');

	})


	}); 


 
	
</script>