(function($){
	
	
	$(document).on("pageinit", "#page-view_table", function(){		
		
		setInterval(check_table_ready, 10000);	

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