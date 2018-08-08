function valDelete(){
	var msg;
	msg = "Apakah anda ingin menghapus data?";
	var ok = confirm(msg);
	if(ok){
		return true;
	}else{
		return false;
	}
}