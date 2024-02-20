let tableSeguimiento;

document.addEventListener("DOMContentLoaded", function () {
  //*** MOSTRAR DATOS EN DATATABLE Y TRADUCCIÓN ***//
  tableSeguimiento = $("#table-seguimiento").dataTable({
    aProcessing: true,
    aServerSide: true,
    ajax: {
      url: " " + base_url + "/Seguimiento/getSeguimiento",
      dataSrc: "",
    },
    columns: [
      { data: "purchase_order_empire" },
      { data: "nombre_completo" },
      { data: "qty_empire" },
      { data: "material_empire" },
      { data: "size_empire" },
      { data: "ship_date_empire" },     
      { data: "options" }
    ],
    resonsieve: "true",
    bDestroy: true,
    iDisplayLength: 10,
    order: [[0, "desc"]],
  });
});


/////////////////////////////////////
// --- CARGAR SELECT CLIENTES --- //
///////////////////////////////////

let comboxCliente = document.querySelector("#comboxCliente");
let Clientes; // Definir la variable Clientes en un ámbito más amplio

// Cargo todos los clientes que tengo en la BD
function cargarCliente() {
  $.ajax({
    type: "GET",
    url: base_url + "Clientes/mostrarClientes",
    success: function (response) {
      // Parsear la respuesta a objeto y asignarla a la variable Clientes
      Clientes = JSON.parse(response);

      let template =
        '<option class="form-control" selected disabled>-- Select --</option>';

      // Generar las opciones del combo box de clientes
      Clientes.forEach((tipo) => {
        template += `<option class="form-control" value="${tipo.cod_customer}">${tipo.nombre_completo}</option>`;
      });

      // Asignar el HTML generado al combo box de clientes
      comboxCliente.innerHTML = template;
    },
  });
}

// Llamar a la función para cargar los clientes
cargarCliente();



/////////////////////////////////////
// --- CARGAR SELECT MATERIAL --- //
///////////////////////////////////

let comboxMaterial = document.querySelector("#comboxMaterial");

//Cargo Todos los paises que tengo en la BD
function cargarMaterial() {
  $.ajax({
    type: "GET",
    url: base_url + "Material/mostrarMaterial",
    success: function (response) {
      //departamentos:Tengo el resultado en objeto
      const Material = JSON.parse(response);

      let template =
        '<option class="form-control" selected disabled>-- Select --</option>';

      Material.forEach((tipo) => {
        template += `<option class="form-control" value="${tipo.cod_material_empire}">${tipo.material_empire}</option>`;
      });

      comboxMaterial.innerHTML = template;
    },
  });
}

//Llamo a la funcion
cargarMaterial();

//////////////////////////////////////
//*** GUARDAR NUEVO SEGUIMIENTO ***//
////////////////////////////////////


// Capturar el formulario de seguimiento
let formSeguimiento = document.querySelector("#formSeguimiento");

// Agregar un evento al formulario para manejar su envío
formSeguimiento.addEventListener("submit", function (e) {
    // Prevenir el envío por defecto del formulario
    e.preventDefault();

    // Capturar los valores del formulario
    let orden = document.querySelector("#orden").value;
    let comboxCliente = document.querySelector("#comboxCliente").value;
    let comboxMaterial = document.querySelector("#comboxMaterial").value;
    let qty = document.querySelector("#qty").value;
    let size = document.querySelector("#size").value;
    let shipDate = document.querySelector("#shipDate").value;

    // Validar si algún campo obligatorio está vacío
    if (
        orden == "" ||
        comboxCliente == "" ||
        comboxMaterial == "" ||
        qty == "" ||
        size == "" ||
        shipDate == ""
    ) {
        // Mostrar un mensaje de error si algún campo está vacío
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

    // Crear una solicitud AJAX para guardar los datos del seguimiento
    let request = new XMLHttpRequest();
    let ajaxUrl = base_url + "/Seguimiento/setSeguimiento";
    let formData = new FormData(formSeguimiento);
    request.open("POST", ajaxUrl, true);
    request.send(formData);

    // Escuchar el evento onload para manejar la respuesta del servidor
    request.onload = function () {
        if (request.status == 200) {
            // Parsear la respuesta JSON del servidor
            let objData = JSON.parse(request.responseText);
            console.log(objData);

            // Verificar si los datos se guardaron correctamente
            if (objData.status) {
                // Capturar el ID del seguimiento guardado
                let seguimientoID = objData.seguimientoID;

                 // Si se está guardando un nuevo registro, generar el reporte
                  if (objData.option === 1) {
                      generarReporte(seguimientoID);
                    }

                // Resetear el formulario
                formSeguimiento.reset();

                // Reiniciar los elementos <select> a su estado inicial
                $('#comboxCliente').trigger('change');
                $('#comboxMaterial').trigger('change');

                // Cerrar el modal de seguimiento
                $("#modalSeguimiento").modal("hide");

                // Actualizar la tabla de seguimiento
                $("#table-seguimiento").DataTable().ajax.reload();

                // Mostrar un mensaje de éxito
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
                // Mostrar un mensaje de error si hubo un problema al guardar los datos
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

// Función para generar el reporte utilizando el ID del seguimiento
function generarReporte(seguimientoID) {
    return new Promise((resolve, reject) => {
        // Redirigir al usuario a la página de generación de reportes con el ID del seguimiento como parámetro en la URL
        let reportURL = "http://localhost/empire/reporte/generarReporte/" + seguimientoID;
        let newWindow = window.open(reportURL, "_blank");

        if (newWindow) {
            // Si la ventana se abrió correctamente, resolver la promesa
            resolve();
        } else {
            // Si hubo un error al abrir la ventana, rechazar la promesa con un mensaje de error
            reject("No se pudo abrir la ventana para generar el reporte.");
        }
    });
}


// Registrar ticket
// Llamar a la función para cargar los clientes
cargarCliente();



// Guarda con estado = 0 para que no se muestre el valor
function Imprimir() {
  let orden = document.querySelector("#orden").value;
  let comboxClienteId = document.querySelector("#comboxCliente").value; // aquí debería ser comboxCliente
  let comboxMaterial = document.querySelector("#comboxMaterial").value;
  let qty = document.querySelector("#qty").value;
  let size = document.querySelector("#size").value;
  let shipDate = document.querySelector("#shipDate").value;
  let notes = document.querySelector("#notes").value;
  
  // Encuentra el cliente en el array Clientes usando su ID
  let clienteSeleccionado = Clientes.find(cliente => cliente.cod_customer == comboxClienteId);
  
  if (
      orden == "" ||
      comboxClienteId == "" || // aquí debería ser comboxCliente
      comboxMaterial == "" ||
      qty == "" ||
      size == "" ||
      shipDate == ""
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
  
  // Crear un objeto FormData
  let formData = new FormData();
  
  // Agregar los datos al objeto FormData
  formData.append('orden', orden);
  // Agregar el ID del cliente al objeto FormData
  formData.append('cliente', comboxClienteId);
  formData.append('material', comboxMaterial);
  formData.append('cantidad', qty);
  formData.append('tamaño', size);
  formData.append('fecha_envio', shipDate);
  formData.append('notas', notes);
  
  let request = new XMLHttpRequest();
  let ajaxUrl = base_url + "/Seguimiento/setTicket";
  request.open("POST", ajaxUrl, true);
  
  // Evento de carga (cuando se complete la solicitud)
  request.onload = function() {
    if (request.status >= 200 && request.status < 400) {
        // La solicitud se completó correctamente
        let response = JSON.parse(request.responseText);
        if (response.success && response.id) {
            // Redirigir al usuario a la página de generación de PDF con el ID del nuevo registro
            // window.location.href = "http://localhost/empire/reporte/generarReporte/" + response.id;

            // Redirigir al usuario a la página de generación de PDF con el ID del nuevo registro
            window.open("http://localhost/empire/reporte/generarReporte/" + response.id, "_blank");

            // Reiniciar el formulario
            formSeguimiento.reset();
           
          // Reiniciar los elementos <select> a su estado inicial
          $('#comboxCliente').trigger('change');
          $('#comboxMaterial').trigger('change');

           // Cerrar el modal
           $("#modalSeguimiento").modal("hide");

            // window.print();
        } else {
            // Mostrar un mensaje de error si falla la inserción
            console.error("Error al guardar el registro.");
        }
    } else {
        // Hubo un error en la solicitud
        console.error("Error al procesar la solicitud.");
    }
};

  
  // Evento de error (cuando ocurre un error durante la solicitud)
  request.onerror = function() {
      console.error("Error de red al procesar la solicitud.");
  };
  
  // Enviar la solicitud con los datos del FormData
  request.send(formData);  

}

//------------------------------------//
// Maximo caracteres permitido en textarea
//------------------------------------//
const textarea = document.getElementById("notes");
const characterCount = document.getElementById("character-count");
const maxLength = 53;

function updateCharacterCount() {
  let currentText = textarea.value.replace(/\n/g, ''); // Eliminar saltos de línea
  const currentLength = currentText.length;

  // Limitar la longitud del texto
  if (currentLength > maxLength) {
    currentText = currentText.substring(0, maxLength);
  }

  // Actualizar el valor del textarea
  textarea.value = currentText;

  // Actualizar el contador de caracteres
  const remainingLength = maxLength - currentText.length;
  if (remainingLength <= 0) {
    characterCount.textContent = `Has alcanzado el límite de caracteres`;
  } else {
    characterCount.textContent = `Caracteres restantes: ${remainingLength}`;
  }
}

textarea.addEventListener("input", updateCharacterCount);

// Actualizar el contador de caracteres al cargar la página
updateCharacterCount();


/////////////////////////////
//*** EDIT SEGUIMIENTO ***//
///////////////////////////

function fntEditSeguimiento(idSeguimiento) {
 

  // Mostrar el modal con los elementos necesarios para la edición
  showEditModal();

  var idSeguimiento = idSeguimiento;

  var request = (request = new XMLHttpRequest());
  var ajaxUrl = base_url + "/Seguimiento/EditSeguimiento/" + idSeguimiento;
  request.open("GET", ajaxUrl, true);
  request.send();

  request.onload = function () {
    if (request.readyState == 4 && request.status == 200) {
      var objData = JSON.parse(request.responseText);

      if (objData.status) {
        document.querySelector("#idSeguimiento").value =
          objData.data.cod_purchase_empire;
        document.querySelector("#orden").value =
          objData.data.purchase_order_empire;
        
        // Establecer el valor para #comboxCliente usando Select2
        $("#comboxCliente").val(objData.data.cod_customer).trigger("change");

        // document.querySelector("#comboxMaterial").value =
        //   objData.data.cod_material_empire;

        // Establecer el valor para #comboxMaterial usando Select2
        $("#comboxMaterial").val(objData.data.cod_material_empire).trigger("change");

        document.querySelector("#idSeguimiento").value = objData.data.cod_purchase_empire;
        document.querySelector("#qty").value = objData.data.qty_empire;
        document.querySelector("#size").value = objData.data.size_empire;
        document.querySelector("#shipDate").value = objData.data.ship_date_empire;
        document.querySelector("#notes").value = objData.data.Notes_empire;
        document.querySelector("#lStatus").value = objData.data.status;
       
        if (objData.data.status == 1) {
          var optionSelect =
            '<option value="1" selected class="notBlock">Activo</option>';
        } else {
          var optionSelect =
            '<option value="2" selected class="notBlock">Inactivo</option>';
        }
        var htmlSelect = `${optionSelect}
                                     <option value="1">Activo</option>
                                     <option value="2">Inactivo</option>
                                   `;
        document.querySelector("#lStatus").innerHTML = htmlSelect;
      }
    }
  };

  

  $("#modalSeguimiento").on("hidden.bs.modal", function (e) {
    document.querySelector("#formSeguimiento").reset();
    // Reiniciar los elementos <select> a su estado inicial
    $('#comboxCliente').trigger('change');
    $('#comboxMaterial').trigger('change');
  });

  $("#modalSeguimiento").modal("show"); //Mostrar modal Editar
  
}



function showEditModal() {
  // Cambiar el título del modal
  document.querySelector("#titleModal").innerHTML = "Update Order";

  // Cambiar el texto del botón de acción
  document.querySelector("#btnText").innerHTML = "Update";

  // Ocultar el botón "Imprimir"
  document.querySelector("#btnImprimir").style.display = "none";

  // Mostrar el botón "Cerrar"
  document.querySelector("#btnCerrar").style.display = "inline-block";

  // Desactivar el campo de entrada "orden"
  //  document.querySelector("#orden").setAttribute("readonly", "true");

  document.querySelector("#formSeguimiento").reset();

  // Mostrar el modal
  $("#modalSeguimiento").modal("show");
}


/////////////////////////////////
//*** DETALLES SEGUIMIENTO ***//
///////////////////////////////

function fntViewSeguimiento(idSeguimiento) {   

    let request = new XMLHttpRequest();
    let ajaxUrl = base_url + "/Seguimiento/getSeguimientoId/" + idSeguimiento;

    request.open("GET", ajaxUrl, true);
    request.send();

    request.onreadystatechange = function () {
      if (request.readyState == 4 && request.status == 200) {
        let objData = JSON.parse(request.responseText);

        $("#modalViewUser").modal("show");
        if (objData.status) {
          document.querySelector("#fechaSystem").innerHTML =
            objData.data.system_date_empire;
          document.querySelector("#notesV").innerHTML =
            objData.data.Notes_empire;
        
        } else {
          swal("Error", objData.msg, "error");
        }
      }
    };   

}



/////////////////////////////////
//*** ELIMINAR SEGUIMIENTO ***//
///////////////////////////////

function fntDelSeguimiento(idSeguimiento) {
  Swal.fire({
    title: "Delete order",
    text: "¿You really want to delete the order.?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete",
  }).then((result) => {
    if (result.isConfirmed) {
      let request = new XMLHttpRequest();
      let ajaxUrl = base_url + "/Seguimiento/delSeguimiento";
      let strData = "idSeguimiento=" + idSeguimiento;
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
            $("#table-seguimiento").DataTable().ajax.reload();

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


//*** HACER QUE EL DATATABLE FUNCIONES ***//
$("#table-seguimiento").DataTable();

function openModal() {

   // Mostrar el modal con los elementos necesarios para un nuevo registro
   showNewModal();  

  $("#modalSeguimiento").modal("show");
  
}

function showNewModal() {
  // Cambiar el título del modal
  document.querySelector("#titleModal").innerHTML = "New tracking";

  // Cambiar el texto del botón de acción
  document.querySelector("#btnText").innerHTML = "Save and Print";

  // Mostrar el botón "Imprimir"
  document.querySelector("#btnImprimir").style.display = "inline-block";

  // Mostrar el botón "Cerrar"
  document.querySelector("#btnCerrar").style.display = "inline-block";

  // Habilitar el campo de entrada "orden"
  // document.querySelector("#orden").removeAttribute("readonly");
  document.querySelector("#formSeguimiento").reset(); 

  // Mostrar el modal
  $("#modalSeguimiento").modal("show");

}

$("#comboxCliente").each(function () {
  $(this).select2({ dropdownParent: $(this).parent() });
});

$("#comboxMaterial").each(function () {
  $(this).select2({ dropdownParent: $(this).parent() });
});

