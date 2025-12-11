@include('layouts.header')
<!-- Page Wrapper -->
<div class="page-wrapper">
	<!-- Page Content -->
	<div class="content container-fluid">
		<!-- Page Header -->
		<div class="page-header">
			<div class="row align-items-center">
				<div class="col">
					<h3 class="page-title">Designations</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
						<li class="breadcrumb-item active">Designation</li>
					</ul>
				</div>
				<div class="col-auto float-right ml-auto">
					<a href="#" class="btn add-btn add_update_button_designation" data-toggle="modal"
						data-target="#add_update_designation"><i class="fa fa-plus"></i> Add Designation</a>
				</div>
			</div>
		</div>
		<!-- /Page Header -->

		<div class="row">
			<div class="col-md-12">
				<div>
					<table class="table table-striped custom-table mb-0 datatable">
						<thead>
							<tr>
								<th style="width: 30px;">#</th>
								<th>Designation Name</th>
								<th>Status</th>
								<th>Created</th>
								<th class="text-right">Action</th>
							</tr>
						</thead>
						<tbody>
							@php $slno = 1; @endphp
							@foreach($designations as $designation)
								<tr>
									<td>{{$slno}}</td>
									<td>{{ $designation->name }}</td>
									<td>{{ $designation->status == 0 ? 'Active' : 'Inactive'}}</td>
									<td>{{ $designation->created_at->format('d-m-Y')}}</td>
									<td class="text-right">
										<div class="dropdown dropdown-action">
											<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
												aria-expanded="false"><i class="material-icons">more_vert</i></a>
											<div class="dropdown-menu dropdown-menu-right">
												<a class="dropdown-item add_update_button_designation" href="#"
													data-toggle="modal" data-target="#add_update_designation" id={{ $designation->id }}><i class="fa fa-pencil m-r-5"></i>
													Edit</a>
												<a class="dropdown-item" href="#" data-toggle="modal"
													data-target="#delete_designation"><i class="fa fa-trash-o m-r-5"></i>
													Delete</a>
											</div>
										</div>
									</td>
								</tr>
								@php $slno++; @endphp
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- /Page Content -->

	<!-- Add Designation Modal -->
	<div id="add_update_designation" class="modal custom-modal fade" role="dialog">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title designation_modal_title">Add Designation</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<input type="hidden" id="id">
						<div class="form-group">
							<label>Designation Name <span class="text-danger">*</span></label>
							<input class="form-control" type="text" id="designation_name">
						</div>
						<div class="form-group">
							<label>Status <span class="text-danger">*</span></label>
							<select class="form-control select" id="status">
								<option value="">Select</option>
								<option value="0">Active</option>
								<option value="1">Inactive</option>
							</select>
						</div>
						<AlertMessageModal></AlertMessageModal>
						<div class="submit-section">
							<button class="btn btn-primary submit-btn submit_designation" type="button"
								id="submit_designation">Submit</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- /Add Designation Modal -->
</div>
<!-- /Page Wrapper -->
@include('layouts.footer')