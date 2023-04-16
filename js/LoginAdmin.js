function handleAdminLoginForm(event) {
  event.preventDefault();

  let username = $("#username").val();
  let password = $("#password").val();

  let sendingData = {
    username: username,
    password: password,
    action: "loginAdmin",
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

        window.location.href = "../views/content.php";
      } else {
        swal(response, {
          buttons: false,
          timer: 3000,
          icon: "error",
        });

        $("#password").val("");
      }
    },
    error: function (data) {
      console.log(data);
    },
  });
}

$("#logAdminForm").on("submit", handleAdminLoginForm);
