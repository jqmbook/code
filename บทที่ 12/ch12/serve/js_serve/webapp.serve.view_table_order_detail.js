(function($){
	
	$(document).on("pageinit", "#page-view_table_order_detail", function(){
	
		$(".link_menu").on("tap", function(){
	
			var amount_element = $(this).find("span.ui-li-aside"); 
					
			$.mobile.changePage("view_menu_order_detail.php",{
				role: "dialog",
				data: {
						table_number: $("#table_num").text(),
						menu_id: amount_element.attr("data-menu_id")
				}			
			});

		});
		
		$("#btn_check_bill").on("click", function(){
			$.ajax({
				url: "check_bill_order.php",
				type: "post",
				dataType: "json",					
				data: { table_number: $("#table_num").text() },
				success: function(data){
							
					if(data.status === "OK"){
						alert("ส่งข้อมูลเช็กบิลเรียบร้อยแล้ว");					
						$.mobile.changePage("view_table.php",{
							reloadPage: true
						});
					}else {
						alert("เกิดข้อผิดพลาดจาก mysql_query():\n " +data.status);
					}				
				
				},
				error: function(){
						alert("เกิดข้อผิดพลาด");
				}
		
			});
		
		});
	
	});

})(jQuery);
