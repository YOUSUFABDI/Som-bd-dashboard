loadUsers();

let btnAction = "Insert";

function openModa() {
  $("#usersModal").modal("show");
}

function handleForm(event) {
  event.preventDefault();

  let id = $("#update_id").val();
  let fullName = $("#full_name").val();
  let gender = $("#gender").val();
  let bloodType = $("#bloodType").val();
  let phonenumber = $("#phonenumber").val();
  let address = $("#address").val();
  let userType = $("#userType").val();
  let gmail = $("#email").val();
  let username = $("#username").val();
  let password = $("#password").val();
  let confirmpass = $("#confirmpass").val();

  let sendingData = {};

  if (btnAction == "Insert") {
    sendingData = {
      fullName: fullName,
      userType: userType,
      bloodType: bloodType,
      gmail: gmail,
      userName: username,
      password: password,
      confirmPass: confirmpass,
      address: address,
      gender: gender,
      phone: phonenumber,
      action: "registerUser",
    };
  } else {
    sendingData = {
      id: id,
      fullName: fullName,
      userType: userType,
      bloodType: bloodType,
      gmail: gmail,
      userName: username,
      address: address,
      gender: gender,
      phone: phonenumber,
      action: "updateUserInfo",
    };
  }

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/manage_user.php",
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

        btnAction = "Insert";
        loadUsers();

        $("#full_name").val("");
        $("#gender").val("");
        $("#bloodType").val("");
        $("#phonenumber").val("");
        $("#address").val("");
        $("#userType").val("");
        $("#email").val("");
        $("#username").val("");
        $("#password").val("");
        $("#confirmpass").val("");

        $("#usersModal").modal("hide");
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

function loadUsers() {
  $("#UsersTable tbody").html("");
  $("#UsersTable thead").html("");

  let sendingData = {
    action: "getAllUser",
  };

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/manage_user.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      let tr = "";
      let th = "";

      if (status) {
        response.forEach((res) => {
          th = "<tr>";
          for (let r in res) {
            th += `<th> <span>${r}</span> </th>`;
          }
          th += `<th> <span>Actions</span> </th>`;
          th += "</tr>";

          tr += "<tr>";
          for (let i in res) {
            tr += `<td> <span>${res[i]}</span> </td>`;
          }
          tr += `<td> <a class="btn btn-info update_info" update_id=${res["id"]}> <i class="fas fa-edit" style="color: #fff;"></i>  </a> &nbsp;&nbsp; 
          
          <a class="btn btn-danger delete_info" delete_id=${res["id"]}> <i class="fas fa-trash" style="color: #fff;"></i> </a> </td>`;
          tr += "</tr>";
        });
        $("#UsersTable tbody").append(tr);
        $("#UsersTable thead").append(th);
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

function fetchUser(id) {
  let sendingData = {
    id: id,
    action: "getUserInfo",
  };

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/manage_user.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      if (status) {
        btnAction = "Update";

        $("#update_id").val(response["id"]);
        $("#full_name").val(response["fullName"]);
        $("#gender").val(response["gender"]);
        $("#bloodType").val(response["bloodType"]);
        $("#phonenumber").val(response["phone"]);
        $("#address").val(response["address"]);
        $("#userType").val(response["userType"]);
        $("#email").val(response["gmail"]);
        $("#username").val(response["username"]);
        $("#password").val(response["password"]);
        $("#confirmpass").val(response["confirmPass"]);

        $("#usersModal").modal("show");
      } else {
        alert(response);
      }
    },
    error: function (data) {
      console.log(data);
    },
  });
}

function deleteUser(id) {
  let sendingData = {
    id: id,
    action: "deleteUser",
  };

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/manage_user.php",
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

        loadUsers();
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

function getUserId() {
  let id = $(this).attr("update_id");
  fetchUser(id);
}

function getUserIdTodelete() {
  let id = $(this).attr("delete_id");
  deleteUser(id);
}

function handleSearchForm(event) {
  event.preventDefault();

  $("#UsersTable tbody").html("");
  $("#UsersTable thead").html("");

  let name = $("#search_name").val();

  if (!name) {
    $("#UsersTable tbody").html(`Nothing Found ‼️`);
  }

  let sendingData = {
    name: name,
    action: "searchName",
  };

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/manage_user.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      let tr = "";
      let th = "";

      if (status) {
        response.forEach((res) => {
          th = "<tr>";
          for (let r in res) {
            th += `<span> <th>${r}</th> </span>`;
          }
          th += `<th> <span>Actions</span> </th>`;
          th += "</tr>";

          tr += "<tr>";
          for (let i in res) {
            tr += `<span> <td>${res[i]}</td> </span>`;
          }
          tr += `<td> <a class="btn btn-info update_info" update_id=${res["id"]}> <i class="fas fa-edit" style="color: #fff;"></i>  </a> &nbsp;&nbsp; 
          
          <a class="btn btn-danger delete_info" delete_id=${res["id"]}> <i class="fas fa-trash" style="color: #fff;"></i> </a> </td>`;
          tr += "</tr>";
        });
        $("#UsersTable tbody").append(tr);
        $("#UsersTable thead").append(th);
      } else {
        console.log(response);
      }
    },
    error: function (data) {
      console.log(data);
    },
  });
}

$("#addNewUser").on("click", openModa);
$("#usersForm").on("submit", handleForm);
$("#UsersTable").on("click", "a.update_info", getUserId);
$("#UsersTable").on("click", "a.delete_info", getUserIdTodelete);
$("#searchBloodType").on("submit", handleSearchForm);
