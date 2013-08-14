(function($){
	
	var last_id = 0;


	$(document).on("pageinit", "#page-view_menu_order", function(){
	
		setInterval(check_new_nemu_order, 30000);	
	
		$(document).on("click", "a.btn_delete_order_menu", function(){
			var menu_element = $(this).parent();
			$.ajax({
				url: "update_order_ready.php",
				type: "post",
				dataType: "json",					
				data: { temp_id: $(this).attr("data-temp_id") },
				success: function(data){

					if(data.status === "OK"){						
						menu_element.remove();
						
					}
				},
				error: function(){
					alert("เกิดข้อผิดพลาด");
				}

			});		
		});
	
		
	}); // pageinit

	var check_new_nemu_order = function(){
		console.log("check new menu order");
		if($("a.btn_delete_order_menu").last().attr("data-temp_id")){		
			last_id = $("a.btn_delete_order_menu").last().attr("data-temp_id");
		}
		
		$.ajax({
			url: "check_new_menu_order.php",
			type: "get",
			dataType: "json",					
			data: { last_temp_id: last_id },
			success: function(data){

				if(data.status === "Have new order"){	
					updateList(data);
				}
				console.log(data.status);					
			
			},
			error: function(){
				alert("เกิดข้อผิดพลาด");
			}
		});	

	};

	function updateList(data){
		var list = "";

		for(var i=0; i<data.newlist.length; i++){
	
			list +=  "<li data-icon;'false'><a class='"+ data.new_last_id +"' href='#'><h1>"+ data.newlist[i].menu_name+"</h1>";
			list +="<p>โต๊ะ: "+ data.newlist[i].table_number +"</p>";		
			list += "<span class='ui-li-count'>"+ data.newlist[i].quantity +"</span></a>";
			list += "<a data-icon='delete' href='#' data-temp_id='"+ data.newlist[i].temp_id +"'";
			list += "class='btn_delete_order_menu'>ลบ</a></li>";		
	
		}
	
		$("#list_view_menu_order").append(list);
		$("#list_view_menu_order").listview("refresh");	
		$("." + data.new_last_id).effect("pulsate", { times:3 }, 1200);	
		
			
	}

})(jQuery);

