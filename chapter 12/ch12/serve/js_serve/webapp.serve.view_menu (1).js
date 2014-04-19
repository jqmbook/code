(function($){

	var change_quantity = false;
	
		$(document).on("pageinit", "#page-view_menu", function(){
	
			
		$(".link_menu").on("tap", function(){
			
			var quan_element = $(this).find("span.ui-li-count"); 
			var quantity = parseInt(quan_element.text());

			quan_element.text(++quantity);
			quan_element.attr("data-update_item","yes");
			//มีการเปลี่ยนแปลงออร์เดอร์ในรายการเมนู
			change_quantity = true;

		});//.link_menu tap

		$(".link_menu").on("swipeleft", function(){
			
			var quan_element = $(this).find("span.ui-li-count"); 
			var quantity = parseInt(quan_element.text());
	
			if(quantity === 0){
				return false;
			}
		
			if(quantity === 1){
				quan_element.text("0");	
			}else {
				quan_element.text(--quantity);
			}
			quan_element.attr("data-update_item","yes");
			change_quantity = true;
		}); //.link_menu swipeleft
	
		$("#btn_summary_menu").on("click",function(){
		
			if(change_quantity === true){						
				// มีการเปลี่ยนแปลงออร์เดอร์ ให้ส่งข้อมูลออร์เดอร์ไปที่ฐานข้อมูลก่อน
				var json_order = createJSON_Order();			
		
				$.ajax({
					type: "POST",
					url: "send_order.php",
					data: { "order": json_order },
					success: function(data){
						change_quantity = false;
					
						$.mobile.changePage( "view_summary.php", {						
							
							changeHash: false,
							data: {
									cat_id: $("#table_num").attr("data-cat_id"),
									table_number: $("#table_num").text()
							}
						});										
					},
					error: function() { 
						alert("เกิดข้อผิดพลาด");
					}				
				});
				
			}else {
				//ไม่มีการเปลี่ยนแปลงออร์เดอร์ ให้เปลี่ยน page ได้เลย
				$.mobile.changePage("view_summary.php", {				
					
					changeHash: false,
					data: {
							cat_id: $("#table_num").attr("data-cat_id"),
							table_number: $("#table_num").text()
					}
				});
			}
		
		}); //btn_summary_menu

		
						
	}); //pageinit page-view_menu

	function createJSON_Order(){

		var jsonOrder = {};

		jsonOrder.table_number = $("#table_num").text();
		jsonOrder.order = [];

		$("#listmenu .ui-li-count[data-update_item]").each(function(index){	
	
					
			jsonOrder.order.push({
									menu_id: $(this).attr("data-menu_id"), 
									quantity: $(this).text()
							  });		

		});		
		//แปลงข้อมูลชนิดออบเจ็กตให้เป็นข้อมูล JSON
		jsonOrder=JSON.stringify(jsonOrder);
		console.log(jsonOrder);

		return jsonOrder;
	
	}		
		
	

})(jQuery);