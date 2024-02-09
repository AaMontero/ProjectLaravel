<x-app-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Full Calendar js</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'>
<link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Calendar') }}
        </h2>
    </x-slot>
    <style>
        /* Estilo del contenedor del calendario */
.fc {
    background-color: #f0f0f0;
    border: 1px solid #ccc;
}

/* Estilo del encabezado del calendario */
.fc-header {
    background-color: #333;
    color: #fff;
}

/* Estilo de la barra de herramientas */
.fc-toolbar {
    background-color: #444;
    color: #fff;
}

/* Estilo del área del calendario */
.fc-view {
    background-color: #fff;
    border: 1px solid #ccc;
}

/* Estilo de los eventos del calendario */
.fc-event {
    background-color: #007bff;
    color: #fff;
    border: 1px solid #007bff;
}

/* Estilo para cuando se pasa el ratón por encima de un evento */
.fc-event:hover {
    background-color: #0056b3;
    border-color: #0056b3;
}
    </style>
    <body>
        <!-- Button trigger modal -->


        <!-- Modal -->
        <div class="modal fade" id="eventoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="estado">Estado</label>
                    <select class="form-select" id="title">
                        <option value="prereservado">Pre-reservado</option>
                        <option value="reservado">Reservado</option>
                        <option value="disponible">Disponible</option>
                    </select>
                    <label for="">titular</label>
                    <input type="text" class="form-control" id="author">
                    <label for="">Descripcion</label>
                    <input type="text" class="form-control" id="note">
                    <label for="">Fecha Inicio</label>
                    <input type="date" class="form-control" id="start_date">
                    <label for="">Fecha salida</label>
                    <input type="date" class="form-control" id="end_date">

                    <span id="titleError" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBtn"></button>
                </div>
            </div>
            </div>
        </div>

         <!-- editar Modal -->
         <div class="modal fade" id="editarModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <label for="estado">Estado</label>
                    <select class="form-select" id="title">
                        <option value="prereserva">Pre-reserva</option>
                        <option value="reserva">Reserva</option>
                        <option value="disponible">Disponible</option>
                    </select>
                    <label for="">Autor</label>
                    <input type="text" class="form-control" id="author">
                    <label for="">Descripcion</label>
                    <input type="text" class="form-control" id="note">
                    <label for="">Fecha Inicio</label>
                    <input type="date" class="form-control" id="start_date">
                    <label for="">Fecha salida</label>
                    <input type="date" class="form-control" id="end_date">

                    <span id="titleError" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateBtn">Actualizar</button>
                </div>
            </div>
            </div>
        </div>


        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="col-md-11 offset-1 mt-5 mb-5">

                        <div id="calendar" ></div>

                    </div>
                </div>
            </div>
        </div>


        <footer class="footer py-4  ">
            <div class="container-fluid">
              <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                  <div class="copyright text-center text-sm text-muted text-lg-start">
                    © <script>
                      document.write(new Date().getFullYear())
                    </script>,
                    made with <i class="fa fa-heart"></i> by
                    <a href="#" class="font-weight-bold" target="_blank">QORI TRAVEL</a>
                    for a better web.
                  </div>
                </div>

              </div>
            </div>
          </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>

    $(document).ready(function(){

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        var evento = @json($event);
        $('#calendar').fullCalendar({

            header:{
            left:'prev, next today',
            center:'title',
            right:'month, agendaWeek, agendaDay'
        },
        locale: 'es',
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
		dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
		dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
        buttonText: {
        today:    'Hoy',
        month:    'Mes',
        week:     'Semana',
        day:      'Día',
        list:     'list'
      },

        events: evento,
        selectable: true,
        selecetHelper: true,
        select: function(start, end, allDays){
            $('#eventoModal').modal('show');
            $('#start_date').val(moment(start).format("Y-MM-DD HH:mm:ss"));

            $('#saveBtn').unbind().click(function(){
                var title = $('#title').val();
                var start_date = $('#start_date').val();
                var end_date = moment(end).format("Y-MM-DD HH:mm:ss");
                var author = $('#author').val();
                var note = $('#note').val();


                $.ajax({
                    url:"{{ route('calendar.store') }}",
                    type:"POST",
                    dataType:'json',
                    data: {
                        title: title,
                        start_date: start_date,
                        end_date: end_date,
                        author: author,
                        note: note,
                        user_id: {{ auth()->id() }}
                    },
                    success:function(response)
                    {
                       $('#eventoModal').modal('hide')
                       $('#calendar').fullCalendar('renderEvent',{
                        'title':response.title,
                        'start':response.start_date,
                        'end'  :response.end_date,
                       });
                       swal("¡Evento Añadido!", "success");
                       location.reload();
                    },
                    error:function(error)
                    {
                        if(error.responseJSON.errors){
                            $('#titleError').html(error.responseJSON.errors.title)
                        }
                    },

                });

            });
        },

        editable: true,
        eventDrop: function(event){
            var id = event.id;
            var start_date = moment(event.start).format('YYYY-MM-DD');
            var end_date = event.end ? moment(event.end).format('YYYY-MM-DD') : moment(event.start).format('YYYY-MM-DD');

            $.ajax({
                    url:"{{ route('calendar.update', '') }}" + '/' + id,
                    type:"PATCH",
                    dataType:'json',
                    data: {
                        title: title,
                        start_date: start_date,
                        end_date: end_date,
                        author: author,
                        note: note,


                    },
                    success:function(response)
                    {
                        swal("Good job!", "Event Updated!", "success");
                    },
                    error:function(error){

                        console.log(error)
                    },

                });
        },

        eventClick: function(event){
            var id = event.id;
            if(confirm('are you sure want to remove it')){
                $.ajax({
                    url:"{{ route('calendar.destroy', '') }}" + '/' + id,
                    type:"DELETE",
                    dataType:'json',
                    // data: {
                    //     start_date: start_date,
                    //     end_date: end_date,
                    // },
                    success:function(response)
                    {
                    $('#calendar').fullCalendar('removeEvents',response)
                        swal("Good job!", "Event Deleted!", "success");
                    },
                    error:function(error){

                        console.log(error)
                    },complete: function() {
                        location.reload(); // Recargar la página después de editar el evento
                    }

                });
            }
        },
        selectAllow: function(event){
            return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1, 'second').utcOffset(false), 'day');
        },

    });
    $("#eventoModal").on("hidden.bs.modal", function(){
        $("#saveBtn").unbind();
    });


});
</script>
</body>
</x-app-layout>

