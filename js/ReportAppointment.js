getAllAppointments();

function getAllAppointments() {
  let sendingData = {
    action: "getAllAppointments",
  };

  $.ajax({
    method: "POST",
    dataType: "JSON",
    url: "../api/report.php",
    data: sendingData,
    success: function (data) {
      let status = data.status;
      let response = data.data;

      let tr = "";

      if (status) {
        response.forEach((res) => {
          console.log(response.length);
          $("#report_appointment").html(
            `Number of appointments are &nbsp;&nbsp;<code>${response.length}</code>&nbsp;&nbsp;`
          );
          tr += "<tr>";
          for (let i in res) {
            tr += `<td> <span>${res[i]}</span> </td>`;
          }
          tr += "</tr>";
        });
        $("#reportAppointmrntTable tbody").append(tr);
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

$("#print_statement").on("click", printStatement);
