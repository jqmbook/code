(function($){
	
	$(document).on("pageinit", "#page-view_table", function(){		
		
		setInterval(check_table_ready, 10000);	

		$("#list_view_table a").on("swipeleft", function(){
		
			var status_element = $(this).find("span.ui-li-count"); 
			if(status_element.text() === "พร้อมเสิร์ฟ"){
				status_element.stop(true, true);
				remove_table_ready(status_element);
			}

		}); 	
		
		$("#list_view_table .ui-li-count").each(function(){
			
			if($(this).text() === "ไม่ว่าง"){
				$(this).hide();
			}
		
		});	
	
	}); //pageinit

	var check_table_ready = function(){
		console.log("check table ready");

		$.ajax({
			url: "check_table_ready.php",		
			dataType: "json",			
			success: function(data){

				update_list_table(data);					
			
			},
			error: function(){					
				alert("เกิดข้อผิดพลาด");
			}
		});
	
	};

	function remove_table_ready(element){
		$.ajax({
			url: "remove_table_ready.php",		
			dataType: "json",
			data: { table_id: element.attr("data-table_id") },			
			success: function(data){
				if(data.status === "OK"){
					element.hide();
				}else {
					alert("ไม่สามารถซ่อน count bubble ได้");
				}		
			},
			error: function(){				
				alert("เกิดข้อผิดพลาด");
			}
		});
	}

	function update_list_table(data){

		var table_id;
		var status;
		var chef_msg;
		var element;

		for(var i=0; i<data.json_table.length; i++){
		
			table_id = data.json_table[i].table_id;
			status = data.json_table[i].table_status;
			chef_msg = data.json_table[i].chef_message;						
			element = $("span:jqmData(table_id='"+ table_id +"')");
						
			element.removeClass("ui-btn-up-e");
			
			if(status === "ไม่ว่าง"){
		
				element.text(status);
				element.hide();
			}else if(status === "ว่าง"){
				element.text(status);
				element.show();
			
			}
		
			if(chef_msg === "ready"){
					
				element.text("พร้อมเสิร์ฟ");
				element.addClass("ui-btn-up-e");
				element.show();
				element.effect("pulsate", { times:6 }, 1200);

			}		
		
		}	
		
	}

})(jQuery);