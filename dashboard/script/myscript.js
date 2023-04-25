//   show result from ajax 

$(document).ready(function() {
    function show_response(response) {
            var hasmessage='empty';
            switch (response.status_code) {
                case '200':
                    hasmessage=response.message;
                    location.reload();
                    break;
                case '1415':
                    hasmessage=response.message;
                    break;
                case response.status_code:
                    hasmessage=response.message;
                    // location.reload();
                    break;
                default:
                    alert("cannot catch response");
                    break;
            }
        $("#myNotifyElem").text(hasmessage);
        $("#myNotifyElem").show();
        setTimeout(function() { $("#myNotifyElem").hide(); }, 1500);
        }
         //   show result from ajax 
         
         
    $("#ProductSubmit").click(function () {
    var catID = $("#catID").val();
    // alert(catID);
    var addCategory_name = $("#addCategory_name").val();
    var addProduct_name = $("#addProduct_name").val();
    var addSell_Price = $("#addSell_Price").val();
    var addActual_Price = $("#addActual_Price").val();
    var addPrimary_image = $("#addPrimary_image").val().replace(/C:\\fakepath\\/i, '');
    var addSecondary_image = $("#addSecondary_image").val().replace(/C:\\fakepath\\/i, '');
    if (catID == "" || addCategory_name == "" || addProduct_name == "" || addActual_Price == "" || addSell_Price == "" || addPrimary_image == "" || addSecondary_image == "") {
      alert("Form filed are empty. Please fill the form properly");
    }
    // if (addActual_Price)
    else {
      // alert(catID);
      $.ajax({
        url: "library/database.php",
        method: "POST",
        data: { catID: catID, addProduct_name: addProduct_name, addSell_Price: addSell_Price, addActual_Price: addActual_Price, addPrimary_image: addPrimary_image, addSecondary_image: addSecondary_image },
        success: function (data) {
        //   alert("Product added successfully");
        //   location.reload();
        var da = JSON.parse(data);
        show_response(da);
        }
      });
    }
  });
         
});