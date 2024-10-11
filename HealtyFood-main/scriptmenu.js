
const firebaseConfig = {
  apiKey: "AIzaSyCGVAlYS6lg6TpTjQJSNYalNokZgXg1PPw",
  authDomain: "chatapp-d5aea.firebaseapp.com",
  databaseURL: "https://chatapp-d5aea-default-rtdb.firebaseio.com",
  projectId: "chatapp-d5aea",
  storageBucket: "chatapp-d5aea.appspot.com",
  messagingSenderId: "80071941953",
  appId: "1:80071941953:web:4be59642f6869f67f24bc0",
  measurementId: "G-FPGF0W9RG2"
};


//ตรวจสอบข้อความที่ค้นหา//    
$("#myinput").keyup(function() {
      var val = $.trim(this.value);
      var header = "logo"
            if (val === "") {
                $('img').show();
            }
            else {
                $('img').hide();
                $("img[alt*=" + val +"]").show();
                $("img[alt*=" + header +"]").show();
            }
      });

