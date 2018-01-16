<!DOCTYPE html>
<html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Controle Ativos</title>

        <!-- Bootstrap -->
        <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset("css/gentelella.min.css") }}" rel="stylesheet">

        <link href="{{ asset("css/pnotify.custom.min.css") }}" rel="stylesheet">

      	<link href="{{ asset("css/sweetalert2.min.css") }}" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css"/>

        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">



        @stack('stylesheets')

    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                @include('includes/sidebar')

                @include('includes/topbar')

                @yield('main_container')

                <div class="modal fade modal-options" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Opções</h4>
                      </div>
                      <div class="modal-body">
                        <p class="lead"></p>
                        <div class="btn-group">
                            <a class="btn btn-primary" id="btn-edit"><i class="fa fa-edit"></i> Editar</a>
                            <a class="btn btn-danger" data-dismiss="modal" id="btn-remove"><i class="fa fa-trash"></i> Inativar</a>
                            <a class="btn btn-danger" id="btn-descart"><i class="fa fa-trash"></i> Descartar</a>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                      </div>

                    </div>
                  </div>
                </div>

                <div class="modal fade modal-options-call" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                  <div class="modal-dialog modal-sm">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Opções</h4>
                      </div>
                      <div class="modal-body">
                        <p class="lead"></p>
                        <div class="btn-group">
                            <a class="btn btn-default btn-block" id="btn-view"><i class="fa fa-eye"></i> Ver</a>
                            <a class="btn btn-primary btn-block" id="btn-editable"><i class="fa fa-edit"></i> Editar</a>
                            <a class="btn btn-danger btn-block" data-dismiss="modal" id="btn-cancel"><i class="fa fa-trash"></i> Inativar</a>
                            <a class="btn btn-success btn-block" id="btn-authorize"><i class="fa fa-check"></i> Autorizar</a>
                            <a class="btn btn-success btn-block" id="btn-entry"><i class="fa fa-check"></i> Iniciar Entrada</a>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                      </div>

                    </div>
                  </div>
                </div>

                @include('includes/footer')

            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ asset("js/jquery.min.js") }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset("js/bootstrap.min.js") }}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset("js/gentelella.min.js") }}"></script>

        <script src="{{ asset("js/pnotify.custom.min.js") }}"></script>

        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>

        <script type="text/javascript" src="{{ asset('js/tableExport.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap-table-export.js') }}"></script>

      	<script src="{{asset('/js/sweatalert2.min.js')}}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.0.28/jspdf.plugin.autotable.js"></script>

        <script>
            $(document).ready(function(){
                $('.datepicker').datepicker({
                    format: 'dd/mm/yyyy',
                    startDate: '0d',
                    language: "pt-BR",
                    autoclose: true,
                    todayHighlight: true
                });

                var $table = $('#table');
                $(function () {
                    $('#toolbar').find('select').change(function () {
                        $table.bootstrapTable('destroy').bootstrapTable({
                            exportDataType: $(this).val()
                        });
                    });
                })

                $('.ui-pnotify').remove();
            });
        </script>

        @stack('scripts')

    </body>
</html>
