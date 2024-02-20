let tableMaterial;

document.addEventListener("DOMContentLoaded", function () {
  //*** MOSTRAR DATOS EN DATATABLE Y TRADUCCIÓN ***//
  tableMaterial = $("#table-material").dataTable({
    aProcessing: true,
    aServerSide: true,
    // language: {
    //   url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
    // },
    ajax: {
      url: " " + base_url + "/Material/getMaterial",
      dataSrc: "",
    },
    columns: [
      { data: "material_empire" },
      { data: "status" },
      { data: "options" },
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
  });
});



///////////////////////////////////
//*** GUARDAR NUEVO MATERIAL ***//
/////////////////////////////////
let formMaterial = document.querySelector("#formMaterial");

formMaterial.addEventListener("submit", function (e) {
  e.preventDefault();

  let idCliente = document.querySelector("#idMaterial").value; //Lo obtengo a la hora que voy a Editar
  let txtDescripcion = document.querySelector("#txtDescripcion").value;
  // let listStatus = document.querySelector("#listStatus").value;

  if (txtDescripcion == "") {
    //Modal error Toast aviso parte superior
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
  let ajaxUrl = base_url + "/Material/setMaterial";
  let formDta = new FormData(formMaterial);
  request.open("POST", ajaxUrl, true);
  request.send(formDta);

  request.onload = function () {
    if (request.status == 200) {
      let objData = JSON.parse(request.responseText);

      if (objData.status) {
        $("#modalMaterial").modal("hide");
        $("#table-material").DataTable().ajax.reload();

        //Modal exito Toast aviso parte superior

        Swal.fire({
          position: "top-end",
          toast: "true",
          icon: "success",
          title: "Correct!",
          text: objData.msg,
          icon: "success",
          confirmButtonText: "Accept",
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
          confirmButtonText: "Accept",
          showConfirmButton: false,
          timer: 5000,
          timerProgressBar: true,
        });
      }
    }
  };
});

//////////////////////////
//*** EDIT MATERUAK ***//
////////////////////////

function fntEditMaterial(idMaterial) {
  // console.log(idMaterial);
  document
    .querySelector(".modal-header")
    .classList.replace("bg-pattern", "bg-pattern-2");

  document.querySelector("#titleModal").innerHTML = "Update Material";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "headerEdit", "bg-pattern-2");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-primary", "btn-info");
  document.querySelector("#btnText").innerHTML = "Update";
  document.querySelector("#formMaterial").reset();

  var idMaterial = idMaterial;

  var request = (request = new XMLHttpRequest());
  var ajaxUrl = base_url + "/Material/EditMaterial/" + idMaterial;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onload = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#idMaterial").value =
          objData.data.cod_material_empire;
        document.querySelector("#txtDescripcion").value =
          objData.data.material_empire;
        document.querySelector("#listStatus").value = objData.data.status;

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
        document.querySelector("#listStatus").innerHTML = htmlSelect;
      }
    }

    //$('#modalEmpleado').modal('show');
  };
  $("#modalMaterial").modal("show"); //Mostrar modal Editar
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

////////////////////////////
//*** REMOVE MATERIAL ***//
//////////////////////////

function fntDelMaterial(idMaterial) {
  Swal.fire({
    title: "Delete Material",
    text: "¿You really want to remove the material?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete",
  }).then((result) => {
    if (result.isConfirmed) {
      let request = new XMLHttpRequest();
      let ajaxUrl = base_url + "/Material/delMaterial";
      let strData = "idMaterial=" + idMaterial;
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
            $("#table-material").DataTable().ajax.reload();

            Swal.fire({
              position: "top-end",
              toast: "true",
              icon: "success",
              title: "DELETE!",
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

//*** HACER QUE EL DATATABLE FUNCIONES ***//
$("#table-material").DataTable();

////////////////////////////////////////////////////
//////// CARGAR SELECT DEPARTAMENTO ////////////////
///////////////////////////////////////////////////

function cargarDepartamento() {
  let formAvaluo = document.querySelector("#formAvaluo");
  let comboxDepa = document.querySelector("#selectDepart");

  let request = new XMLHttpRequest();
  let ajaxUrl = base_url + "/Clientes/obtenerDepartamento";
  let formData = new FormData(formAvaluo);

  request.open("POST", ajaxUrl, true);
  //request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send(formData);
  //console.log(request)

  request.onload = function () {
    if (request.status == 200) {
      let objData = JSON.parse(this.response);

      let template =
        '<option class="form-control" selected disabled>-- Seleccione --</option>';

      objData.forEach((tipo) => {
        template += `<option class="form-control" value="${tipo.idDep}">${tipo.descripcion}</option>`;
      });

      comboxDepa.innerHTML = template;

      $("#selectDepart").change(function () {
        let id = this.id;
        let idDepartamento = $("#" + id).val();

        listar_municipios(idDepartamento);
      });
    }
  };
}

//*** MANDAR A LLAMAR AL MODAL: Agregar una nueva marca ***//
function openModal() {
  document.querySelector("#idMaterial").value = "";
  document
    .querySelector(".modal-header")
    .classList.replace("bg-pattern-2", "bg-pattern");

  document.querySelector("#titleModal").innerHTML =
    "<span class='title-modal'>New material</span>";
  document
    .querySelector(".modal-header")
    .classList.replace("headerRegister", "bg-pattern-2", "headerEdit");
  document
    .querySelector("#btnActionForm")
    .classList.replace("btn-info", "btn-primary");
  document.querySelector("#btnText").innerHTML = "Save";
  document.querySelector("#formMaterial").reset();

  $("#modalMaterial").modal("show");
}
