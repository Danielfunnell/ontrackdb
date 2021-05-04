import{deleteMessage} from './deleteMessage';
import{replyMessage} from './reply';

const getMessages = document.querySelectorAll('.messages__item');
const messageBox = document.getElementById("message-box");

getMessages.forEach(function(message){
  message.addEventListener("click", function(){
    const messageValue = this.dataset.value
   
    if (messageValue == "") {
      messageBox.innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log('success')
          messageBox.innerHTML = this.responseText;
          $('#exampleModal').modal('show')
          deleteMessage();
          replyMessage();
          
         
          

        }
      };
      xmlhttp.open("GET","message.php?q="+messageValue,true);
      xmlhttp.send();
    }

  })
})

export {messageBox};