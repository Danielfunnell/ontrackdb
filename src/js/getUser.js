import{progress} from './progress';


const getUser = document.getElementById('select-user');

getUser.addEventListener("change", function(){
  const str = this.value
  
  if (str == "") {
    document.getElementById("results").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          console.log('success')
        document.getElementById("results").innerHTML = this.responseText;
        progress();
      }
    };
    xmlhttp.open("GET","getuser.php?q="+str,true);
    xmlhttp.send();
  }
})