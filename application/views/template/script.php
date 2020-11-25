<script type="text/javascript">
	$(document).ready(function(){
		$("*").dblclick(function(e){
		    e.preventDefault();
		    return false;
		});

		$('.table-dt').DataTable({
            "dom": "<'row'<'col-md-6'l><'col-md-6'f>><'row'<'col-md-12't>><'row'<'col-md-6'i><'col-md-6'p>>",
            order : [],
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            
        });

        $('.btn-delete').click(function() {
			if(confirm('Are you sure you want to delete this?')){
				return true;
			}
			return false;
		});
    });
</script>


