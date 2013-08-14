(function($){
	
	$(document).on("pageinit", "#page-view_table_check_bill", function(){
		
		setInterval(check_bill_table, 10000);	

	}); // pageinit

	var check_bill_table = function(){
		console.log("check_bill_table");
	
		$.ajax({
			url: "check_bill_table.php",
			type: "get",
			dataType: "html",	
			
			success: function(data){
				
				$("#list_view_table_check_bill").html(data);
				$("#list_view_table_check_bill").listview("refresh");
			
			},
			error: function(){
				alert("เกิดข้อผิดพลาด");
			}
		});	
		
	};

})(jQuery);