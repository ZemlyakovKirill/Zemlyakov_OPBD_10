var ch_field=document.querySelector("#choice_field");

function choice_field(element,ref){
    document.getElementById("choice_list").style.display="block";
    document.getElementById("choice_list").style.left=element.getBoundingClientRect().left;
    document.getElementById("create_choice").href="create"+ref+".php";
    document.getElementById("update_choice").href="update"+ref+".php";
    document.getElementById("detail_choice").href="detail"+ref+".php";
    document.getElementById("list_choice").href=ref+"list.php";
}
document.getElementById('choice_id').onkeyup=function(){
    document.getElementById('choice_id').value=document.getElementById('choice_id').value.replace(/[^0-9]/g,"");
    document.cookie="id="+document.getElementById('choice_id').value;
}