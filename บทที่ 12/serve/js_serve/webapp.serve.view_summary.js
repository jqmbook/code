(function($){
	
		$(document).on("pageinit", "#page-view_summary", function(){			
	
		$("#closebutton").on("click", function(){
			var back_to_page;
	
			if($("#table_num").attr("data-cat_id")){
				back_to_page = "view_menu.php";
			}else {
				back_to_page = "view_category.php";
			}					
			
			$.mobile.changePage(back_to_page, {
				changeHash: false,						
				data: { cat_id: $("#table_num").attr("data-cat_id"), 
					   table_number:$("#table_num").text() }
			});
			
		}); 
		
		$("#confirm_order").on("click", function(){
			$.ajax({
				type: "POST",
				url: "confirm_order.php",
				data: { "table_number": $("#table_num").text() },			  

				success: function(data){
					
					$.mobile.changePage("view_table.php",{
						reloadPage: true 
					});
				 
				},

				error: function() { 
					alert("เกิดข้อผิดพลาด");
				}				
			});
	
		}); 
	
	
		
	}); // pageinit page-view_summary



})(jQuery);