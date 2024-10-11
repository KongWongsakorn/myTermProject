$("#search").keyup(function() {
    var val = $.trim(this.value);
    var header = "menu"
          if (val === "") {
              $('img').show();
          }
          else {
              $('img').hide();
              $("img[alt*=" + val +"]").show();
              $("img[alt*=" + header +"]").show();
          }
    });

