function validateEmail(email) {
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var address = email;
   if(reg.test(address) == false) {
      return false;
   }
	 else {
			return true;
	 }
}
