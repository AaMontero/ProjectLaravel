<x-app-layout>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Full Calendar js</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <body>
        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>

        <!-- Modal -->
        <div class="modal fade" id="eventoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="">Estado</label>
                    <input type="text" class="form-control" id="title">
                    <label for="">Autor</label>
                    <input type="text" class="form-control" id="author">
                    <label for="">Nota</label>
                    <input type="text" class="form-control" id="note">

                    <span id="titleError" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveBtn">Save changes</button>
                </div>
            </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="col-md-11 offset-1 mt-5 mb-5">

                        <div id="calendar"></div>

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
        events: evento,
        selectable: true,
        selecetHelper: true,
        select: function(start, end, allDays){
            $('#eventoModal').modal('toggle');

            $('#saveBtn').click(function(){
                var title = $('#title').val();
                var start_date = moment(start).format('YYYY-MM-DD');
                var end_date = moment(end).format('YYYY-MM-DD');
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
                       $('#calendar').fullCalendar('renderEvents',{
                        'title':response.title,
                        'start':response.start_date,
                        'end'  :response.end_date,
                       });
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
    })

});
</script>
</body>
</x-app-layout>

