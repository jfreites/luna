@extends('luna::admin_layout')

@section('content')

    <h2 class="sub-header">Page Manager</h2>

    <div class="container-fluid">

        @if (session('message'))
            <div class="alert alert-warning">
                {{ session('message') }}
            </div>
        @endif

        <p>
            <a class="btn btn-success" href="{{ url('admin/page/create') }}">Crear Página »</a>
        </p>
        <p>Arrastra para order tus páginas y luego haz click en 'Guardar'</p>

        <div id="orderResult"></div>
        <input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
        <input type="button" id="save" value="Guardar" class="btn btn-primary" />
    </div>

@endsection()

@section('extra-css')

    <!-- sortable functionality -->
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css" />

    <style>
        .placeholder {
            outline: 1px dashed #4183C4;
        }

        .mjs-nestedSortable-error {
            background: #fbe3e4;
            border-color: transparent;
        }

        #tree {
            width: 550px;
            margin: 0;
        }

        ol {
            max-width: 450px;
            padding-left: 25px;
        }

        ol.sortable,ol.sortable ol {
            list-style-type: none;
        }

        .sortable li div {
            border: 1px solid #d4d4d4;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            cursor: move;
            border-color: #D4D4D4 #D4D4D4 #BCBCBC;
            margin: 0;
            padding: 3px;
        }

        li.mjs-nestedSortable-collapsed.mjs-nestedSortable-hovering div {
            border-color: #999;
        }

        .disclose, .expandEditor {
            cursor: pointer;
            width: 20px;
            display: none;
        }

        .sortable li.mjs-nestedSortable-collapsed > ol {
            display: none;
        }

        .sortable li.mjs-nestedSortable-branch > div > .disclose {
            display: inline-block;
        }

        .sortable span.ui-icon {
            display: inline-block;
            margin: 0;
            padding: 0;
        }
        .menuDiv {
            background: #EBEBEB;
        }

        .menuEdit {
            background: #FFF;
        }

        .itemTitle {
            vertical-align: middle;
            cursor: pointer;
        }

        .editItem {
            float: right;
            cursor: pointer;
        }
        #orderResult p,ol,ul,pre,form {
            margin-top: 0;
            margin-bottom: 1em;
        }*/
    </style>
@endsection

@section('extra-js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nestedSortable/2.0.0/jquery.mjs.nestedSortable.min.js"></script>

    <script>
        $(function() {

            $('#orderResult').html('<p>.... cargando</p>');

            $.get('/admin/page/order_ajax', {}, function(data){
                $('#orderResult').html(data);
            });

            $("#save").click(function(){

                var oSortable = $('.sortable').nestedSortable('toArray');

                $.ajax({
                    url: "/admin/page/order_ajax",
                    type:"POST",
                    beforeSend: function (xhr) {
                        //var token = $('meta[name="csrf_token"]').attr('content');
                        var token = $('#csrf_token').val();

                        if (token) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                        }
                    },
                    data: { sortable: oSortable },
                    success:function(data){
                        $('#orderResult').html(data);
                        $('#orderResult').slideDown();
                        alert('Item relocated');
                    },
                    error:function(){
                        alert("error!!!!");
                    }
                }); //end of ajax
            });

            $('body').on('click','.editItem', function(e) {
                e.preventDefault();
                var id = $(this).attr('data-id');
                var redirect_url = '/admin/page/'+id+'/edit';

                window.location.href = redirect_url;
            });
        });
    </script>
@endsection