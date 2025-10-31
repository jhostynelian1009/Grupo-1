function EliminarActividad(){
  $('#formulario_eliminar_actividad').submit(function(e){
    e.preventDefault();

    Swal.fire({
      title: '¿Estás seguro?',
      text: "Esta acción no se puede revertir",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Sí, eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: '../backend/api/endpoint.php',
          type: 'DELETE',
          dataType: 'json',
          data: {
            eliminar_actividad_deletemethod: true,
            id: $('#id').val(),
          },
          success: function(data){
            console.log(data);
            if(data.success){
              Swal.fire({
                icon: 'success',
                title: '¡Eliminado!',
                text: 'La actividad ha sido eliminada correctamente',
                showConfirmButton: false,
                timer: 1500
              }).then(() => {
                window.location.href = 'index.html';
              });
            } else {
              Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al eliminar la actividad',
                confirmButtonText: 'Aceptar'
              });
            }
          },
          error: function(error){
            console.log(error);
            Swal.fire({
              icon: 'error',
              title: 'Error de conexión',
              text: 'No se pudo conectar con el servidor',
              confirmButtonText: 'Aceptar'
            });
          }
        });
      }
    });
  });
}


function CrearActividad(){
   $('#formulario_crear_actividad').submit(function(e){
     e.preventDefault();
   $.ajax({
     url: '../backend/api/endpoint.php',
     type: 'POST',
     dataType: 'json',
     data: {
       crear_actividad_postmethod: true,
       actividad: $('#actividad').val(),
       descripcion: $('#descripcion').val(),
       estado: $('#estado').val(),
     },
     success: function(data){
       console.log(data);
       if(data.success){
         Swal.fire({
           icon: 'success',
           title: '¡Éxito!',
           text: 'Actividad creada correctamente',
           showConfirmButton: false,
           timer: 1500
         }).then(() => {
           $('#formulario_crear_actividad')[0].reset();
           window.location.href = 'index.html';
         });
       } else {
         Swal.fire({
           icon: 'error',
           title: 'Error',
           text: 'Error al crear la actividad',
           confirmButtonText: 'Aceptar'
         });
       }
     },
     error: function(error){
       console.log(error);
       Swal.fire({
         icon: 'error',
         title: 'Error de conexión',
         text: 'No se pudo conectar con el servidor',
         confirmButtonText: 'Aceptar'
       });
     }
   });
 });
 }

 function agregarobservaicion() {
    $('#formulario_agregar_observacion')
    .submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: '../backend/api/endpoint.php',
            type: 'POST',
            dataType: 'json',
            data: {
                agregar_observacion_postmethod: true,
                id: $('#id').val(),
                observacion: $('#observacion').val(),
            },
            success: function (data) {
                console.log(data);
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Observación agregada correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function () {
                        $('#formulario_agregar_observacion')[0].reset();
                        window.location.href = 'ver_actividad.html?id=' + encodeURIComponent($('#id').val());
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al agregar la observación',
                        confirmButtonText: 'Aceptar'
                    });
                }
            },
            error: function (xhr, status, err) {
                console.error('AJAX error:', status, err);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Ocurrió un error en la petición. Revisa la consola.'
                });
            }
        });
    });
}
          
          function EditarActividad(){
  // Obtener el ID de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');
  
  if(!id){
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No se proporcionó un ID válido',
      confirmButtonText: 'Aceptar'
    }).then(() => {
      window.location.href = 'index.html';
    });
    return;
  }

  // Cargar los datos de la actividad
  $.ajax({
    url: '../backend/api/endpoint.php',
    type: 'GET',
    dataType: 'json',
    data: {
      obtener_actividad_por_id: true,
      id: id
    },
    success: function(response){
      console.log(response);
      if(response.success){
        const actividad = response.data;
        $('#id').val(actividad.id);
        $('#actividad').val(actividad.actividad);
        $('#descripcion').val(actividad.descripcion);
        $('#estado').val(actividad.estado);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Actividad no encontrada',
          confirmButtonText: 'Aceptar'
        }).then(() => {
          window.location.href = 'index.html';
        });
      }
    },
    error: function(error){
      console.log(error);
      Swal.fire({
        icon: 'error',
        title: 'Error de conexión',
        text: 'No se pudo cargar la actividad',
        confirmButtonText: 'Aceptar'
      });
    }
  });

  // Manejar el envío del formulario
  $('#formulario_editar_actividad').submit(function(e){
    e.preventDefault();
    $.ajax({
      url: '../backend/api/endpoint.php',
      type: 'POST',
      dataType: 'json',
      data: {
        editar_actividad_postmethod: true,
        id: $('#id').val(),
        actividad: $('#actividad').val(),
        descripcion: $('#descripcion').val(),
        estado: $('#estado').val(),
      },
      success: function(data){
        console.log(data);
        if(data.success){
          Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: 'Actividad actualizada correctamente',
            showConfirmButton: false,
            timer: 1500
          }).then(() => {
            window.location.href = 'index.html';
          });
        } else {
          Swal.fire({
            icon: 'info',
            title: 'Información',
            text: data.message,
            confirmButtonText: 'Aceptar'
          });
        }
      },
      error: function(error){
        console.log(error);
        Swal.fire({
          icon: 'error',
          title: 'Error de conexión',
          text: 'No se pudo actualizar la actividad',
          confirmButtonText: 'Aceptar'
        });
      }
    });
  });
}

function VerActividad(){
  // Obtener el ID de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');
  
  if(!id){
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No se proporcionó un ID válido',
      confirmButtonText: 'Aceptar'
    }).then(() => {
      window.location.href = 'index.html';
    });
    return;
  }

  // Cargar los datos de la actividad
  $.ajax({
    url: '../backend/api/endpoint.php',
    type: 'GET',
    dataType: 'json',
    data: {
      obtener_actividad_por_id: true,
      id: id
    },
    success: function(response){
      console.log(response);
      if(response.success){
        const actividad = response.data;
        $('#actividad').text(actividad.actividad);
        $('#descripcion').text(actividad.descripcion);
        
        // Convertir el estado numérico a texto
        let estadoTexto = '';
        switch(actividad.estado){
          case '0':
            estadoTexto = 'Pendiente';
            break;
          case '1':
            estadoTexto = 'Completado';
            break;
          case '2':
            estadoTexto = 'En progreso';
            break;
          default:
            estadoTexto = 'Desconocido';
        }
        $('#estado').text(estadoTexto);
        $('#fecha_creacion').text(actividad.fecha_de_creacion);
        $('#fecha_actualizacion').text(actividad.fecha_de_actualizacion);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Actividad no encontrada',
          confirmButtonText: 'Aceptar'
        }).then(() => {
          window.location.href = 'index.html';
        });
      }
    },
    error: function(error){
      console.log(error);
      Swal.fire({
        icon: 'error',
        title: 'Error de conexión',
        text: 'No se pudo cargar la actividad',
        confirmButtonText: 'Aceptar'
      });
    }
  });
}

function CargarActividadParaEliminar(){
  // Obtener el ID de la URL
  const urlParams = new URLSearchParams(window.location.search);
  const id = urlParams.get('id');
  
  if(!id){
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'No se proporcionó un ID válido',
      confirmButtonText: 'Aceptar'
    }).then(() => {
      window.location.href = 'index.html';
    });
    return;
  }

  // Establecer el ID en el campo oculto
  $('#id').val(id);

  // Cargar los datos de la actividad
  $.ajax({
    url: '../backend/api/endpoint.php',
    type: 'GET',
    dataType: 'json',
    data: {
      obtener_actividad_por_id: true,
      id: id
    },
    success: function(response){
      console.log(response);
      if(response.success){
        const actividad = response.data;
        $('#actividad').text(actividad.actividad);
        $('#descripcion').text(actividad.descripcion);
        
        // Convertir el estado numérico a texto
        let estadoTexto = '';
        switch(actividad.estado){
          case '0':
            estadoTexto = 'Pendiente';
            break;
          case '1':
            estadoTexto = 'Completado';
            break;
          case '2':
            estadoTexto = 'En progreso';
            break;
          default:
            estadoTexto = 'Desconocido';
        }
        $('#estado').text(estadoTexto);
        $('#fecha_creacion').text(actividad.fecha_de_creacion);
        $('#fecha_actualizacion').text(actividad.fecha_de_actualizacion);
      } else {
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: 'Actividad no encontrada',
          confirmButtonText: 'Aceptar'
        }).then(() => {
          window.location.href = 'index.html';
        });
      }
    },
    error: function(error){
      console.log(error);
      Swal.fire({
        icon: 'error',
        title: 'Error de conexión',
        text: 'No se pudo cargar la actividad',
        confirmButtonText: 'Aceptar'
      });
    }
  });
}

function MostrarActividad(){
 
      $.ajax({
        url: '../backend/api/endpoint.php',
        type: 'GET',
        dataType: 'json',
        data: {
          mostar_actividades_getmethod: true
        },
        success: function(data){
         console.log(data);
          let tbody= document.querySelector('tbody');
          tbody.innerHTML ='';
          data.forEach(element => {
                // Convertir el estado numérico a texto
                let estadoTexto = '';
                switch(String(element.estado)){
                  case '0':
                    estadoTexto = 'Pendiente';
                    break;
                  case '1':
                    estadoTexto = 'Completado';
                    break;
                  case '2':
                    estadoTexto = 'En progreso';
                    break;
                  default:
                    estadoTexto = 'Desconocido';
                }

                // Construir elementos DOM de forma segura para evitar XSS
                const tr = document.createElement('tr');

                const tdId = document.createElement('td');
                tdId.textContent = element.id;
                tr.appendChild(tdId);

                const tdActividad = document.createElement('td');
                tdActividad.textContent = element.actividad;
                tr.appendChild(tdActividad);

                const tdDescripcion = document.createElement('td');
                tdDescripcion.textContent = element.descripcion;
                tr.appendChild(tdDescripcion);

                const tdEstado = document.createElement('td');
                tdEstado.textContent = estadoTexto;
                tr.appendChild(tdEstado);

                const tdFechaCreacion = document.createElement('td');
                tdFechaCreacion.textContent = element.fecha_de_creacion;
                tr.appendChild(tdFechaCreacion);

                const tdFechaActualizacion = document.createElement('td');
                tdFechaActualizacion.textContent = element.fecha_de_actualizacion;
                tr.appendChild(tdFechaActualizacion);

                const createLinkButton = (href, text, className) => {
                  const td = document.createElement('td');
                  const a = document.createElement('a');
                  a.href = href;
                  a.textContent = text;
                  a.className = className;
                  td.appendChild(a);
                  return td;
                };

                tr.appendChild(createLinkButton(`ver_actividad.html?id=${encodeURIComponent(element.id)}`, 'Ver', 'btn btn-info'));
                tr.appendChild(createLinkButton(`editar_actividad.html?id=${encodeURIComponent(element.id)}`, 'Editar', 'btn btn-warning'));
                tr.appendChild(createLinkButton(`eliminar_actividad.html?id=${encodeURIComponent(element.id)}`, 'Eliminar', 'btn btn-danger'));

                tbody.appendChild(tr);
              });
        },
        error: function(error){
          console.log(error);
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudieron cargar las actividades',
            confirmButtonText: 'Aceptar'
          });
        }
      });
   }