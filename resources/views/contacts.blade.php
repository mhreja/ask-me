@extends('admin.layouts.app')

@section('title','Contacts')

    @section('head')
    <style>
  		.modal .modal-dialog-aside{width: 40%; max-width:80%; height: 100%; margin:0;transform: translate(0); transition: transform .2s;}
		.modal .modal-dialog-aside .modal-content{height: inherit; border:0; border-radius: 0;}
		.modal .modal-dialog-aside .modal-content .modal-body{overflow-y: auto }
		.modal.fixed-left .modal-dialog-aside{margin-left:auto;  transform: translateX(100%); }
		.modal.fixed-right .modal-dialog-aside{margin-right:auto; transform: translateX(-100%); }
		.modal.show .modal-dialog-aside{transform: translateX(0);  }
        @media only screen and (max-width: 1024px) {
		  .modal .modal-dialog-aside{width: 80%;}
		}
  	</style>
    @endsection

    
    @section('content')

    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Contacts</h1>

	    <div class="card shadow mb-4">
	        <div class="card-header py-3">
	            <!-- <h6 class="m-0 font-weight-bold text-primary">Contacts</h6> -->
	            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong" onclick="createContact()">
    	          <i class="fa fa-plus"></i> Add New
    	        </button>
	        </div>
	        <div class="card-body">
	            <div class="table-responsive">
	                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
	                    <thead>
	                        <tr>
	                            <th>Name</th>
	                            <th>Father</th>
	                            <th>Email</th>
	                            <th>Action</th>
	                        </tr>
	                    </thead>
	                    <tfoot>
	                        <tr>
	                            <th>Name</th>
	                            <th>Father</th>
	                            <th>Email</th>
	                            <th>Action</th>
	                        </tr>
	                    </tfoot>
	                </table>
	            </div>
	        </div>
	    </div>


    	<!-- Modal -->
    	<div class="modal fixed-left fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    	  <div class="modal-dialog modal-dialog-aside" role="document">
    	    <div class="modal-content">
    	      <div class="modal-header">
    	        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
    	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    	          <span aria-hidden="true">&times;</span>
    	        </button>
    	      </div>
    	      <div class="modal-body">
    	        <form id="myForm">
    	        	<div class="form-group">
    	        		<label>Name</label>
    	        		<input type="text" class="form-control" name="name" placeholder="John Doe">
    	        		<span class="invalid-feedback" role="alert" id="nameError"></span>
    	        	</div>
    	        	<div class="form-group">
    	        		<label>Father's Name</label>
    	        		<input type="text" class="form-control" name="father" placeholder="Daniel Mark">
    	        		<span class="invalid-feedback" role="alert" id="fatherError"></span>
    	        	</div>
    	        	<div class="form-group">
    	        		<label>Email ID</label>
    	        		<input type="email" class="form-control" name="email" placeholder="john@doe.com">
    	        		<span class="invalid-feedback" role="alert" id="emailError"></span>
    	        	</div>
    	        </form>
    	      </div>
    	      <div class="modal-footer">
    	        <button type="button" class="btn btn-outline-dark" data-dismiss="modal" id="modalClose">Close</button>
    	        <button type="button" class="btn btn-dark" onclick="formReset()">Reset</button>
    	        <button type="button" class="btn btn-success btnSave" onclick="storeContact()"><i></i>Insert</button>
    	        <button type="button" class="btn btn-info btnUpdate" onclick="updateContact()">Update</button>
    	      </div>
    	    </div>
    	  </div>
    	</div>
    </div>
    
    @endsection

    

    



    @section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous"></script>
    <script>
    	$('input').on('input', function() {
		    $(this).removeClass('is-invalid');
		    $(this).addClass('is-valid');
		});
    </script>
    <script>
    	$.ajaxSetup({
    		headers: {'X-CSRF-Token': '{{ csrf_token() }}'}
    	});

    	function getRecords(){
	    	$.ajax({
			    type: "GET",
			    url: "{{route('contacts.getdata')}}",
			    success: function (data) {
			        //console.log(data)
			        $('#dataTable').dataTable({
			        	data: data,
			        	columns: [
			        	     {data: 'name'},
			        	     {data: 'father'},
			        	     {data: 'email'},
			        	     {data: 'id' , render : function (data) {
					              return '<button class="btn btn-info btnEdit" data-id="'+ data +'" data-toggle="modal" data-target="#exampleModalLong"><i class="fa fa-edit"></i></button> <button class="btn btn-danger btnDelete" data-id="'+ data +'"><i class="fa fa-trash"></i></button>';
					            }},
			        	]
			        })

			    }
			});
    	};
    	//Load Table Data from Database
    	getRecords()


    	function formReset() {
		  $("#myForm input").each(function(){
		  	$(this).val(null)
		  })
		}

		function createContact(){
			formReset();
			$('input').removeClass('is-invalid'); //Removes previous error class
			$('.modal-title').text('New Contact');
			$('.btnSave').show();
			$('.btnUpdate').hide();
		}

		function storeContact(){
			$(".btnSave").prop('disabled', true); //Disable button to resist more than 1 time submitting same data
			$(".btnSave").html('<i class="fas fa-spinner fa-spin"></i> Inserting');
			//if(!confirm('Are You Sure?')) return;
			$.ajax({
				type: "POST",
				url: "{{ route('contacts.store') }}",
				// data: getInputs(),
				data: $("#myForm").serialize(),
				success: function(data){
					$('input').removeClass('is-invalid');
					formReset();
					$(".btnSave").prop('disabled', false); //remove disable tag after successfully inserting data
					$(".btnSave").html('Insert');
					$('#modalClose').click();
					$("#dataTable").DataTable().destroy();
					getRecords();
					$.bootstrapGrowl(data.message , {
						ele: "body", //On which Element to Append
						type: "success", //This is for color
						offset: {from: "top", amount:20}, //Top or Bottom
						align: "right",
						width: 250, 
						delay: 800,
						allow_dismiss: true,
					});
				},
				error: function(response){
					$('input').removeClass('is-invalid');
					if (response.responseJSON.hasOwnProperty('errors')) {
						$(".btnSave").prop('disabled', false); //remove disable tag if has error
						$(".btnSave").html('Insert');
						$.each(response.responseJSON.errors, function(key, value){
							//console.log(key+value)
							$('input[name="'+key+'"]').addClass('is-invalid');
							$('#'+key+'Error').html('<strong>'+value+'</strong>');
						})
						$.bootstrapGrowl("Error" , {
							ele: "body", //On which Element to Append
							type: "danger", //This is for color
							offset: {from: "top", amount:20}, //Top or Bottom
							align: "right",
							width: 250, 
							delay: 800,
							allow_dismiss: true,
						});
					}
				}
			})
		}

		$('table').on('click', '.btnEdit', function(){
			$('.modal-title').text('Edit Contact');
			$('.btnSave').hide();
			$('.btnUpdate').show();

			//Get Values and Id
			var id = $(this).attr('data-id');
			var name = $(this).parent().parent().find('td').eq(0).text();
			var father = $(this).parent().parent().find('td').eq(1).text();
			var email = $(this).parent().parent().find('td').eq(2).text();
			  
			    //Create URL for update and make it global variable
				window.updateURL = "{{route('contacts.update',':id')}}";
			    updateURL = updateURL.replace(':id', id); 

			//Put the value in input fileds
			$('input[name="name"]').val(name);
			$('input[name="father"]').val(father);
			$('input[name="email"]').val(email);			
		})


		function updateContact(){
			$.ajax({
				type: "PUT",
				url: window.updateURL,
				data: $("#myForm").serialize(),
				success: function(data){
					$('input').removeClass('is-invalid');
					//console.log(data)
					$('#modalClose').click();
					$("#dataTable").DataTable().destroy();
					getRecords();
					$.bootstrapGrowl(data.message , {
						ele: "body", //On which Element to Append
						type: "success", //This is for color
						offset: {from: "top", amount:20}, //Top or Bottom
						align: "right",
						width: 250, 
						delay: 800,
						allow_dismiss: true,
					});
				},
				error: function(response){
					$('input').removeClass('is-invalid');
					if (response.responseJSON.hasOwnProperty('errors')) {
						$.each(response.responseJSON.errors, function(key, value){
							//console.log(key+value)
							$('input[name="'+key+'"]').addClass('is-invalid');
							$('#'+key+'Error').html('<strong>'+value+'</strong>');
						})
						$.bootstrapGrowl(data.message , {
							ele: "body", //On which Element to Append
							type: "danger", //This is for color
							offset: {from: "top", amount:20}, //Top or Bottom
							align: "right",
							width: 250, 
							delay: 800,
							allow_dismiss: true,
						});
					}
				}
			})
		}

		$('table').on('click', '.btnDelete', function(){
			if(!confirm('Are you sure that you really want to delete it?')) return;
			//Get the Id
			var id = $(this).attr('data-id');
			// Craete Delete URL 
			var deleteURL = "{{route('contacts.delete',':id')}}";
			deleteURL = deleteURL.replace(':id', id);

			    $.ajax({
					type: "DELETE",
					url: deleteURL,
					success: function(data){
						$("#dataTable").DataTable().destroy();
						getRecords();
						$.bootstrapGrowl(data.message , {
							ele: "body", //On which Element to Append
							type: "info", //This is for color
							offset: {from: "top", amount:20}, //Top or Bottom
							align: "right",
							width: 250, 
							delay: 800,
							allow_dismiss: true,
						});
					}
				})        
		});
    </script>

    @endsection