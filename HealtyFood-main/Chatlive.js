
const db = firebase.firestore()


/*localStorage.setItem("email", email);*/

 



  
  var email = localStorage.getItem("email");
  var namer;
  console.log("email",email);
  
  db.collection("User").doc(email).get()
  .then(function (doc) {
    if(doc.exists){
    namer = doc.data().Username;      
    console.log("name",namer)
    localStorage.setItem("namer", namer)
    var namer = localStorage.getItem("namer");

    
    }
    else{
      console.log("does not exist")
      alert("Successfully")
    }
  })
  .catch(function(error){

    console.log("error",error)
  })
   
    var namer = localStorage.getItem("namer");
    var msg ="อยู่ในห้องแชทแล้ว"
    if(msg =="อยู่ในห้องแชทแล้ว"){
        firebase.database().ref("messages").push({
            msg:msg,
            sender: namer
        }).then(function(){
            document.getElementById('msg_text').value="";
        
        })
    }
    
    function like(){
        var namer = localStorage.getItem("namer");
        var like ="❤️"
        if(like !=""){
            firebase.database().ref("messages").push({
                msg:like,
                sender: namer
            }).then(function(){
                document.getElementById('msg_text').value="";
            
            })
        }
    }   
  


  



function send()
{
    
    
    var namer = localStorage.getItem("namer");
    var msg =document.getElementById('msg_text').value;
    if(msg !=""){
        firebase.database().ref("messages").push({
            msg:msg,
            sender: namer
        }).then(function(){
            document.getElementById('msg_text').value="";
        
        })
    }
}
function back()
{
   
   
   
   var namer = localStorage.getItem("namer");
   var msg ="ได้ออกไปแล้ว"
   if(msg =="ได้ออกไปแล้ว"){
       firebase.database().ref("messages").push({
           msg:msg,
           sender: namer
       }).then(function(){
           document.getElementById('msg_text').value="";
       
       })
   }
   
   firebase.database().ref("messages").remove();
    window.location.replace("menu.html");
}

let ref= firebase.database().ref("messages").on('child_added' , function(snapshot){
    var username = snapshot.val().sender;
    var msg =snapshot.val().msg;
    var html ="";
    let namer = localStorage.getItem("namer");
    
    
    if (username == 'Nutrian')
    {
        
        if(username == namer){
            
            html += "<div class='message_me' align='right'><p class='usergod'>♛" +username +"</p><p class='msg_megod'>"+msg+"</p</div>";
            document.getElementById("box_messages").innerHTML += html;
            
    
        }
        else{
            html += "<div class='message_user' align='left'><p class='usergod'>♛" +username +"</p><p class='msg_usergod'>"+msg+"</p</div>";
            document.getElementById("box_messages").innerHTML += html;
            
        }
        var div_ob =document.getElementById("box_messages");
        div_ob.scrollTop = div_ob.scrollHeight;
    }
    else{
        if(username == namer){
            html += "<div class='message_me' align='right'><p class='user'>" +username +"</p><p class='msg_me'>"+msg+"</p</div>";
            document.getElementById("box_messages").innerHTML += html;
            
    
        }
        else{
            html += "<div class='message_user' align='left'><p class='user'>" +username +"</p><p class='msg_user'>"+msg+"</p</div>";
            document.getElementById("box_messages").innerHTML += html;
    }
    var div_ob =document.getElementById("box_messages");
    div_ob.scrollTop = div_ob.scrollHeight;
    }
})
