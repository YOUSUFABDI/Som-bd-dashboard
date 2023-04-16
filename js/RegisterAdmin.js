function handleAdminRegForm(event) {
  event.preventDefault();

  let gmail = $("#gmail").val();
  let username = $("#username").val();
  let password = $("#password").val();

  let sendingData = {
    gmail: gmail,
    username: username,
    password: password,
    action: "registerAdmin",
  };

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/admin.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        swal(response, {
          buttons: false,
          timer: 3000,
          icon: "success",
        });

        $("#gmail").val("");
        $("#username").val("");
        $("#password").val("");
      } else {
        swal(response, {
          buttons: false,
          timer: 3000,
          icon: "error",
        });
      }
    },
    error: function (data) {
      console.log(data);
    },
  });
}

$("#regAdminForm").on("submit", handleAdminRegForm);
