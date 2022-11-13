// All JS functions are declared here 

function edit_item(id,url){
    window.location.href=url+'?edit='+id;  
}

function change_status(id,url){
    window.location.href=url+'?active='+id;  
}

function delete_item(id,url){
    window.location.href=url+'?delete='+id;  
}