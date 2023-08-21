$(function(){
	$("#btnSearch").click(function(){
		var parent = $(this).parent();
		var nilai = $("#filter").val();
		var data={'id':nilai};
		var target_combo = $("#conten_pesan");
		var url = "kontak/get-pesan";
		cari_ajax_combo("post", parent, data, target_combo, url);
	})
})

var ContactUs = function () {

    return {
        //main function to initiate the module
        init: function () {
			var map;
			$(document).ready(function(){
			  map = new GMaps({
				div: '#map',
				lat: -13.004333,
				lng: -38.494333
			  });
			   var marker = map.addMarker({
		            lat: -13.004333,
					lng: -38.494333,
		            title: 'Loop, Inc.',
		            infoWindow: {
		                content: "<b>Loop, Inc.</b> 795 Park Ave, Suite 120<br>San Francisco, CA 94107"
		            }
		        });

			   marker.infoWindow.open(map, marker);
			});
        }
    };

}();