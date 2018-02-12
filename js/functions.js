function update_pins(){
	var pinAdmin = jQuery("#pin_manager").val();
	var pinManager = jQuery("#pin_admin").val();
	jQuery.post("/?mode=settings&method=update_pins",
				{pin_admin:pinAdmin,
				 pin_manager:pinManager},
				 function(data){
					alert(data);
				 });
}