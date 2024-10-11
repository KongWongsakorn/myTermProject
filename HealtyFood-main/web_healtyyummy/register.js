const auth =firebase.auth()
var user =auth.currentUser
const db = firebase.firestore()


const Register_button = document.getElementById("Regbtn");
Register_button.addEventListener("click",Register);


function Register(){
    var email = document.getElementById("emailFieldR").value
    var password = document.getElementById("passwordFieldR").value
    var checkpassword = document.getElementById("passwordFieldRG").value
    var username =document.getElementById('usernameFieldR').value

    var cusername = username.toUpperCase()
    if (checkpassword != password)
    {
        Swal.fire({
            icon: 'error',
            title: 'PASSWORD',
            text: 'check you confirm password',
            
        })
    }

    else if (cusername == 'NUTRIAN')
    {
        Swal.fire({
            icon: 'error',
            title: 'USERNAME',
            text: 'cant use name Nutrian',
            
        })
    
    }
    else{

    
    auth.createUserWithEmailAndPassword(email, password)
        .then ((userCredential) => {
                user = userCredential.user;
                console.log("Successfully Registered with ("+ user.email +")");
                console.log("Successfully Register");
                console.log("UID : "+ user.uid);
                
                
                 console.log("Success")
                
                 Swal.fire({
                    icon: 'success',
                    title: 'Register Success',
                    text: 'GGEZ',
                })
                
                auth.signInWithEmailAndPassword(email, password)
                db.collection("User").doc(email).set({
                    Username : username,
                    Email : email,
                    Password : password,
                    UID      : user.uid
                })
              
            })
            .catch((error) => {
                var errorCode = error.code
                var errorMessage = error.message
                console.log("Error " + errorCode + " : " + errorMessage)
                Swal.fire({
                    icon: 'error',
                    title: 'OMG',
                    text: 'Somethingwrong',
                    footer: errorMessage
                })
            })
       }
}