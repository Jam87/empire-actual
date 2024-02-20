let tableClientes;

document.addEventListener("DOMContentLoaded", function () {
  //*** MOSTRAR DATOS EN DATATABLE Y TRADUCCIÓN ***//
  tableClientes = $("#table-clientes").dataTable({
    aProcessing: true,
    aServerSide: true,
    ajax: {
      url: " " + base_url + "/Clientes/getClientes",
      dataSrc: "",
    },
    columns: [
      { data: "nombre_completo" },
      { data: "horario_completo" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
  });
});

//////////////////////////////////
//*** GUARDAR NUEVO CLIENTE ***//
////////////////////////////////
let formCliente = document.querySelector("#formCliente");

formCliente.addEventListener("submit", function (e) {
  e.preventDefault();

  //let idCliente = document.querySelector("#idCliente").value; //Lo obtengo a la hora que voy a Editar
  let nombres = document.querySelector("#nombres").value;
  let apellidos = document.querySelector("#apellidos").value;
  let horaApertura = document.querySelector("#horaApertura").value;
  let horaCierre = document.querySelector("#horaCierre").value;

  if (
    nombres == "" ||
    apellidos == "" ||
    horaApertura == "" ||
    horaCierre == ""
  ) {
    Swal.fire({
      position: "top-end",
      toast: "true",
      icon: "warning",
      title: "Error!",
      text: "Fields with an asterisk cannot be empty",
      icon: "warning",
      confirmButtonText: "Accept",
      showConfirmButton: false,
      timer: 5000,
      timerProgressBar: true,
    });

    return false;
  }

  let request = new XMLHttpRequest();
  let ajaxUrl = base_url + "/Clientes/setClientes";
  let formDta = new FormData(formCliente);
  request.open("POST", ajaxUrl, true);
  request.send(formDta);

  request.onload = function () {
    if (request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        $("#modalCliente").modal("hide");
        $("#table-clientes").DataTable().ajax.reload();

        //Modal exito Toast aviso parte superior

        Swal.fire({
          position: "top-end",
          toast: "true",
          icon: "success",
          title: "Correcto!",
          text: objData.msg,
          icon: "success",
          confirmButtonText: "Aceptar",
          showConfirmButton: false,
          timer: 5000,
          timerProgressBar: true,
        });
      } else {
        //Modal error Toast aviso parte superior

        Swal.fire({
          position: "top-end",
          toast: "true",
          icon: "warning",
          title: "Error!",
          text: objData.msg,
          icon: "warning",
          confirmButtonText: "Aceptar",
          showConfirmButton: false,
          timer: 5000,
          timerProgressBar: true,
        });
      }
    }
  };
});

////////////////////////
//*** EDIT CLIENT ***//
//////////////////////

function fntEditCliente(idClient) {
  // console.log(idClient);
  document
    .querySelector(".modal-header")
    .classList.replace("bg-pattern", "bg-pattern-2");

  document.querySelector("#titleModal").innerHTML = "Update client";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerEdit", "bg-pattern-2");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Update";
  document.querySelector("#formCliente").reset();

  var idClient = idClient;

  var request = (request = new XMLHttpRequest());
  var ajaxUrl = base_url + "/Clientes/EditClient/" + idClient;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onload = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#idCliente").value = objData.data.cod_customer;
        document.querySelector("#nombres").value = objData.data.nombres_empire;
        document.querySelector("#apellidos").value =
          objData.data.apellidos_empire;
        document.querySelector("#horaApertura").value =
          objData.data.opening_hours_empire;
        document.querySelector("#horaCierre").value =
          objData.data.closing_time_empire;
        document.querySelector("#lStatus").value = objData.data.status;

        //Renderiza los options: Tipo usuario y Estado

        //Pongo por defaul el activo que es
        if (objData.data.status == 1) {
          var optionSelect =
            '<option value="1" selected class="notBlock">Active</option>';
        } else {
          var optionSelect =
            '<option value="2" selected class="notBlock">Inactive</option>';
        }
        var htmlSelect = `${optionSelect}
                                    <option value="1">Active</option>
                                    <option value="2">Inactive</option>
                                  `;
        document.querySelector("#lStatus").innerHTML = htmlSelect;
      }
    }

    //$('#modalEmpleado').modal('show');
  };
  $("#modalCliente").modal("show"); //Mostrar modal Editar
}

/////////////////////////////
//*** ELIMINAR CLIENTE ***//
///////////////////////////

function fntDelCliente(idCliente) {
  Swal.fire({
    title: "Delete Client",
    text: "¿You really want to delete the client?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete",
  }).then((result) => {
    if (result.isConfirmed) {
      let request = new XMLHttpRequest();
      let ajaxUrl = base_url + "/Clientes/delCliente";
      let strData = "idCliente=" + idCliente;
      request.open("POST", ajaxUrl, true);
      request.setRequestHeader(
        "Content-type",
        "application/x-www-form-urlencoded"
      );
      request.send(strData);
      request.onload = function () {
        if (request.status == 200) {
          let objData = JSON.parse(request.responseText);

          //objData.status: Valido si es verdadero.
          //Va a mostrar el mensaje
          if (objData.status) {
            $("#table-clientes").DataTable().ajax.reload();

            Swal.fire({
              position: "top-end",
              toast: "true",
              icon: "success",
              title: "Eliminate!",
              text: objData.msg,
              icon: "success",
              confirmButtonText: "Accept",
              showConfirmButton: false,
              timer: 3000,
              timerProgressBar: true,
            });
          } else {
            swal("Attention!", objData.msg, "error");
          }
        }
      };
    }
  });
}

/////////////////////////////
//*** DETALLES CLIENTE ***//
///////////////////////////

function fntViewCliente(idcliente) {
  //console.log(idcliente);
  let request = new XMLHttpRequest();
  let ajaxUrl = base_url + "/Clientes/getCliente/" + idcliente;

  request.open("GET", ajaxUrl, true);
  request.send();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let objData = JSON.parse(request.responseText);

      $("#modalViewUser").modal("show");
      if (objData.status) {
        document.querySelector("#celPago").innerHTML = objData.data.descripcion;
        document.querySelector("#celImpuesto").innerHTML =
          objData.data.excepto_impuesto;
        document.querySelector("#celCedula").innerHTML = objData.data.cedula;
        document.querySelector("#celCorreo").innerHTML = objData.data.email;
        document.querySelector("#celRuc").innerHTML = objData.data.numero_ruc;
        document.querySelector("#celEjecutivo").innerHTML =
          objData.data.ejecutivo;
        document.querySelector("#celFechaNormal").innerHTML =
          objData.data.fechaInspeccionNormal;
        document.querySelector("#celFechaRapida").innerHTML =
          objData.data.fechaInspeccionRapida;
        document.querySelector("#celHora").innerHTML =
          objData.data.horaInspeccionNormal;
        document.querySelector("#celConversional").innerHTML =
          objData.data.telefono;
        document.querySelector("#celExtension").innerHTML =
          objData.data.extension;
        document.querySelector("#celMovil").innerHTML = objData.data.movil;
        document.querySelector("#celDireccion").innerHTML =
          objData.data.direccion;
        document.querySelector("#celObservacion").innerHTML =
          objData.data.observaciones;
      } else {
        swal("Error", objData.msg, "error");
      }
    }
  };
}

//*** HACER QUE EL DATATABLE FUNCIONES ***//
$("#table-clientes").DataTable();

//*** MANDAR A LLAMAR AL MODAL: Agregar una nueva marca ***//
function openModal() {
  document.querySelector("#idCliente").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("bg-pattern-2", "bg-pattern");

  document.querySelector("#titleModal").innerHTML =
    "<span class='title-modal'>New client</span>";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "bg-pattern-2", "headerEdit");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Save";
  document.querySelector("#formCliente").reset();

  $("#modalCliente").modal("show");
}
