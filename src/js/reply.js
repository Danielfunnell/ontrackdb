import {messageBox} from './getMessage';



function replyMessage() {

    const reply = document.getElementById('reply');
    const replyValue = document.getElementById('reply-message');
    

    reply.addEventListener("click", function(event){
    const message = replyValue.value
    const userId = reply.dataset.value
    
    console.log(userId)
//create key value pairs
        var vars = "message="+message+"&userId="+userId;

        if(message == "") {
            messageBox.innerHTML = ""
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    messageBox.innerHTML = userId;
                }
            }

            xmlhttp.open("POST", "ajax.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded")

            // send variables over to php file
            xmlhttp.send(vars);
        } 
            
        })

}

export {replyMessage}


