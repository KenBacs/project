	<script type="text/javascript">
		$(document).ready(function(){
	$('.hover').popover({
		title: fetchData, 
		html:true,
		placement:'right'
	});

	function fetchData(){
		var fetch_data = '';
		var element = $(this);
		var id = element.attr("id");
		$.ajax({
			url:"../fetch.php"
			method:"POST",
			async:false,
			data: {id:id},
			success:function(data){
				fetch_data = data;
			}

		});
		return fetch_data;
	}
});
	</script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="javascripts/jquery-3.2.1.min.js"></script>
    <script src="javascripts/bootstrap.min.js"></script>
    <script src="javascripts/myscript.js"></script>

  </body>
</html>