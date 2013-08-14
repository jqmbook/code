(function($){

	$(document).on("pageinit", "#page-view_category", function(){
	
	$("#btn_summary_category").on("click",function(){
		
		$.mobile.changePage("view_summary.php", {
			// ไม่มีการเปลี่ยน url ใน address bar ทำให้กดปุ่ม Back หรือ Forward กลับมาไม่ได้
			changeHash: false,
			data: { table_number: $("#table_num").text() }
		});

	});
	
});

})(jQuery);


