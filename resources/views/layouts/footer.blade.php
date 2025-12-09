</div>
		<!-- /Main Wrapper -->
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
		
		<!-- Slimscroll JS -->
		<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>
		
		<!-- Chart JS -->
		 <!--
		<script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
		<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
		<script src="{{asset('assets/js/chart.js')}}"></script>
        -->
		<!-- Custom JS -->
		<script src="{{asset('assets/js/app.js')}}"></script>

		<!-- Datatable JS -->
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/dataTables.bootstrap4.min.js"></script>

		<script src="assets/js/jquery-confirm.min.js"></script>

		<script src="js/common.js"></script>
		@stack('js')
		
		@if(!empty($controllerJs))
		    @foreach($controllerJs as $js)
			   <script src="{{ $js }}"></script>
			@endforeach
		@endif
		<script>
    var employeesDataUrl = "{{ route('employees.data') }}";  // Blade syntax will generate the correct URL
</script>
	</body>
</html>


