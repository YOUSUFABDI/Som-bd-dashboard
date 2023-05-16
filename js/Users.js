loadUsers();

let btnAction = "Insert";

function openModa() {
  $("#usersModal").modal("show");
}

function handleForm(event) {
  event.preventDefault();

  const errorMessages = [];

  validateForm(errorMessages);

  // checking if error exists
  if (errorMessages.length > 0) return;

  registerUser();
}

function registerUser() {
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

  let sendingData = {};

  if (btnAction == "Insert") {
    sendingData = {
      fullName: fullName,
      userType: userType,
      bloodType: bloodType,
      gmail: gmail,
      userName: username,
      password: password,
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

function validateForm(errorMessages) {
  // get err paragraphs
  const errName = document.querySelector(".err_name");
  const errPhone = document.querySelector(".err_phone");
  const errGmail = document.querySelector(".err_gmail");
  const errUsername = document.querySelector(".err_username");
  const errPassword = document.querySelector(".err_pass");
  const errAddress = document.querySelector(".err_address");

  // get input elements to validate
  const fullName = document.querySelector("#full_name");
  const phoneNumber = document.querySelector("#phonenumber");
  const gmail = document.querySelector("#email");
  const userName = document.querySelector("#username");
  const password = document.querySelector("#password");
  const address = document.querySelector("#address");

  // check input values if they null or valid
  // name
  const validName = new RegExp(
    /^[\w'\-,.][^0-9_!¡?÷?¿/\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/
  );
  if (!validName.test(fullName.value)) {
    errorMessages.push("enter your name");
    errName.innerText = "enter your name";
  } else {
    errName.innerText = "";
  }

  // phone
  const validPhone = new RegExp(/^[6]\d{8}$/);
  if (!validPhone.test(phoneNumber.value)) {
    errorMessages.push("invalid phone number");
    errPhone.innerText = "invalid phone number";
  } else {
    errPhone.innerText = "";
  }

  // gmail
  const validGmail = new RegExp(/^[\w.+\-]+@gmail\.com$/);
  if (!validGmail.test(gmail.value)) {
    errorMessages.push("invalid gamil");
    errGmail.innerText = "invalid gamil";
  } else {
    errGmail.innerText = "";
  }

  // username
  if (!validName.test(userName.value)) {
    errorMessages.push("invalid username");
    errUsername.innerText = "invalid username";
  } else {
    errUsername.innerText = "";
  }

  // password
  const validPassword = new RegExp(/^.{8,30}$/);
  if (!validPassword.test(password.value)) {
    errorMessages.push("inavlid password");
    errPassword.innerText = "invalid password";
  } else {
    errPassword.innerText = "";
  }

  // address
  if (!address.value) {
    errorMessages.push("invalid address");
    errAddress.innerText = "invalid address";
  } else {
    errAddress.innerText = "";
  }
}

$("#addNewUser").on("click", openModa);
$("#usersForm").on("submit", handleForm);
$("#UsersTable").on("click", "a.update_info", getUserId);
$("#UsersTable").on("click", "a.delete_info", getUserIdTodelete);
$("#searchBloodType").on("submit", handleSearchForm);
