import {messageBox} from './getMessage';

function deleteMessage() {

  
    // delete message
    
        const deleteButton = document.getElementById('delete-btn')
        deleteButton.addEventListener("click", function(){
            
           
            const val = this.dataset.value
            console.log(val)
            if(val == "") {
                messageBox.innerHTML = ""
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log('deleted')
                        messageBox.innerHTML = this.responseText;
                    }
                }

                xmlhttp.open("GET","ajax.php?q="+val,true);
                xmlhttp.send();
            } 
            
           
            
        })




}

export {deleteMessage};

