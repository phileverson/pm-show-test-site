    $(document).ready(function(){
      $("#send").click(function(){
        var name   = $("#name").val();
        var email  = $("#email").val();
        var message  = $("#message").val();
		var datepicker  = $("#datepicker").val();
		var person_num  = $("#person_num").val();

        var error = false;

         if(email.length == 0 || email.indexOf("@") == "-1" || email.indexOf(".") == "-1"){
           var error = true;
           $("#error_email").fadeIn(500);
         }else{
           $("#error_email").fadeOut(500);
         }
		 
		  if(datepicker.length == 0){
            var error = true;
            $("#error_datepicker").fadeIn(500);
         }else{
            $("#error_datepicker").fadeOut(500);
         }
		 
		 if(person_num.length == 0){
            var error = true;
            $("#error_person_num").fadeIn(500);
         }else{
            $("#error_person_num").fadeOut(500);
         }
         
         if(error == false){
           $("#send").attr({"disabled" : "true", "value" : "Loading..." });
            
           $.ajax({
             type: "POST",
             url : "send.php",    
             data: "name=" + name + "&email=" + email + "&subject=" + "You Got Email" + "&date =" + datepicker + "&person_num =" + person_num + "&message=" + message,
             success: function(data){    
              if(data == 'success'){
                $("#btnsubmit").remove();
                $("#mail_success").fadeIn(500);
              }else{
                $("#mail_failed").html(data).fadeIn(500);
                $("#send").removeAttr("disabled").attr("value", "send");
              }     
             }  
           });  
        }
		    return false;                      
      });    
    });
