getAllDonors();

function getAllDonors() {
  $("#donorsTable tbody").html("");
  $("#donorsTable thead").html("");

  let sendingData = {
    action: "getAllDonors",
  };

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/donors_recpients.php",
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
          th += "</tr>";

          tr += "<tr>";
          for (let i in res) {
            tr += `<td> <span>${res[i]}</span> </td>`;
          }
          tr += "</tr>";
        });
        $("#donorsTable tbody").append(tr);
        $("#donorsTable thead").append(th);
      } else {
        console.log(response);
      }
    },
    error: function (data) {
      console.log(data);
    },
  });
}

function printStatement() {
  let printArea = document.querySelector("#print_area");
  let newWindow = window.open("");

  newWindow.document.write(`<html><head><title></title>`);
  newWindow.document.write(`<style media="print"> 
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
  
  body{
    font-family: 'Poppins', sans-serif;
  }

  table{
    width: 100%
  }

  th{
    background-color: #04AA6D !important;
    color: white !important;
  }

  th,td{
    padding: 15px !important;
    text-align: left !important;
    border-bottom: 1px solid #ddd !important;
  }
  </style>`);
  newWindow.document.write(`</head><body>`);
  newWindow.document.write(`Logo Possition`);
  newWindow.document.write(printArea.innerHTML);
  newWindow.document.write(`</body></html>`);
  newWindow.print();
  newWindow.close();
}

function handleSearchForm(event) {
  event.preventDefault();

  $("#donorsTable tbody").html("");
  $("#donorsTable thead").html("");

  let bloodType = $("#search_blood_type").val();

  if (!bloodType) {
    $("#donorsTable tbody").html(`Nothing Found ‼️`);
  }

  let sendingData = {
    bloodType: bloodType,
    action: "getBloodName",
  };

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/donors_recpients.php",
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
          th += "</tr>";

          tr += "<tr>";
          for (let i in res) {
            tr += `<span> <td>${res[i]}</td> </span>`;
          }
          tr += "</tr>";
        });
        $("#donorsTable tbody").append(tr);
        $("#donorsTable thead").append(th);
      } else {
        console.log(response);
      }
    },
    error: function (data) {
      console.log(data);
    },
  });
}

$("#print_statement").on("click", printStatement);
$("#searchBloodType").on("submit", handleSearchForm);
