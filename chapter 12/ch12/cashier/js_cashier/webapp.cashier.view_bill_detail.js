(function($){
	
	$(document).on("pageinit", "#page-view_bill_detail", function(){
	
		$("#btn_print").on("click",function(){			
			window.print();
		});	
	
		$("#select_payment_type").on("change", function(){
			if($("#select_payment_type").val() === "CREDIT CARD"){
				$("#txt_cash_pay").hide();
			}else {
				$("#txt_cash_pay").show();
			}
		});	
	
		$("#pay_bill").on("click", function(){
			var txt_cash = parseInt($('#txt_cash_pay').val());
			var total = parseInt($('#bill_total').text());
			var payment_type = $("#select_payment_type").val();

			if(payment_type === "CASH" && $.isNumeric(txt_cash) === false){
				alert("กรุณากรอกตัวเลข");
				return false;
			}
			
			if(payment_type === "CREDIT CARD"){
				txt_cash = total;
			}		
		
			if(txt_cash < total){
				alert("จำนวนเงินที่รับมาไม่พอค่าอาหารครับ");
				return false;
			}	
			
			var change = txt_cash - total;

			var line1 = "<div class='ui-block-a' style='width:10%'></div><div class='ui-block-b' style='width:65%'>"+ payment_type +"</div>";
			line1 += "<div class='ui-block-c'>" +txt_cash +"</div>";
		
			var line2 = "<div class='ui-block-a'></div><div class='ui-block-b'>ทอน</div>";
			line2 += "<div class='ui-block-c'>" +change +"</div>";				
	
			$.ajax({
				url: "payment_complete.php",
				type: "post",
				dataType: "json",
				data: { pay_type:payment_type,
					    bill_id:$("#bill_id").text() },
				success: function(data){
					if(data.status === "OK"){	
						$("div[data-role='footer']").hide();
						alert("ชำระเงินเรียบร้อยแล้ว");
						$("#grid_bill_detail").append(line1);
						$("#grid_bill_detail").append(line2);
					}
				},
				error: function(){					
					alert("เกิดข้อผิดพลาด");
				}
			}); 	
		
		}); 

	}); // pageinit

})(jQuery);