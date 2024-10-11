
/*const firestore = firebase.firestore();
   var user = auth.currentUser;*/
 
   let Login_Button = document.getElementById("Logbtn");
   Login_Button.addEventListener("click",Login);
   
   function Login(){
       var email = document.getElementById("emailField").value;
       var password = document.getElementById("passwordField").value;
       /*ไว้ดึงชื่อให้แชทบ๊อกไม่รู้ได้ป่าว*/
       var namechat = document.getElementById("usernameFieldR").value;
       localStorage.setItem("name", namechat);
       
   
       auth.signInWithEmailAndPassword(email, password)
           .then ((userCredential) => {
                   user = userCredential.user;
                   console.log("Successfully Sign In");
                   console.log("UID :"+ user.uid);
                   Swal.fire({
                    icon: 'success',
                    title: 'login Success',
                    text: 'GGEZ',
                })
                  
                window.location.replace("menu.html");
               })
               .catch((error) => {
                   var errorCode = error.code;
                   var errorMessage = error.message;
                   console.log("error " + errorCode + " : " + errorMessage);
                   Swal.fire({
                    icon: 'error',
                    title: 'OMG',
                    text: 'Somethingwrong Checkyourpassword or email',
                    footer: errorMessage
                })
               });
           }