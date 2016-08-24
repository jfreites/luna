@extends('luna::admin_layout')

@section('content')

<<<<<<< HEAD
    <h2 class="sub-header">Editar: {{ $page->title }}</h2>
=======
    <h2 class="sub-header">Crear una nueva página</h2>
>>>>>>> aa15e913b09cd4e9a1d9cec25811e406f426083c

    <div class="container-fluid">
        <form action="{{ url('admin/page/'.$page->id) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="PUT">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#info" aria-controls="info" role="tab" data-toggle="tab">Info</a></li>
                <li role="presentation"><a href="#content" aria-controls="content" role="tab" data-toggle="tab">Contenido</a></li>
                <li role="presentation"><a href="#assets" aria-controls="assets" role="tab" data-toggle="tab">Styles & Scripts</a></li>
                <li role="presentation"><a href="#metas" aria-controls="metas" role="tab" data-toggle="tab">Metas</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="info">
                    <div class="form-group">
                        <label for="title">Título de la página</label>
                        <input type="text" class="form-control" name="title" id="title" value="{{ $page->title }}">
                    </div>
                    <!--<div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" name="slug" id="slug" placeholder="...">
                    </div>-->
                    <div class="form-group">
                        <label for="template">Plantilla</label>
                        <select class="form-control" id="template" name="template">
                            <option value="page" selected="selected">Page</option>
                            <option value="post">Blog Post</option>
                        </select>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="visible_in_navi" value="1" checked="checked"> ¿Aparece en la navegación?
                        </label>
                        <p class="help-block">Desmarcar esta casilla para evitar que la pagina esté visible en la navegación del sitio.</p>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="status" value="0"> ¿Guardar como borrador?
                        </label>
                        <p class="help-block">Marcar esta casilla para guardar la página como borrador y no estará publicada</p>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="content">
                    <div class="form-group">
                        <label for="body">Contenido HTML de la página</label>
                        <textarea class="form-control" name="body" id="body" rows="60">{{ $page->body }}</textarea>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="assets">
                    <div class="form-group">
                        <label for="body">Estilos CSS</label>
                        <textarea class="form-control" name="css" id="css" rows="15">{{ $page->css }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="body">Scripts JS</label>
                        <textarea class="form-control" name="js" id="js" rows="15">{{ $page->js }}</textarea>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="metas">
                    <div class="form-group">
                        <label for="meta_title">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title" id="meta_title" value="{{ $page->meta_title }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_keywords">Meta Keywords</label>
                        <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{ $page->meta_keywords }}">
                    </div>
                    <div class="form-group">
                        <label for="meta_description">Meta Description</label>
                        <input type="text" class="form-control" name="meta_description" id="meta_description" value="{{ $page->meta_description }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Editar</button>
        </form>
        <hr>
        <form action="{{ url('admin/page/'.$page->id) }}" method="post">
            {{ csrf_field() }}
<<<<<<< HEAD
=======
            <!--<input type="hidden" name="_method" value="DELETE">-->
>>>>>>> aa15e913b09cd4e9a1d9cec25811e406f426083c
            {{ method_field('DELETE') }}
            <input type="submit" class="btn btn-xs btn-danger" value="Eliminar Página">
        </form>
    </div>

<<<<<<< HEAD
@endsection

@section('extra-js')

    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.2/summernote.js"></script>
    <script src="http://code.nanakii.fr/summernote-plugins/plugin/template/summernote-ext-template.js"></script>

    <script>
        $(document).ready(function() {
            $('#body').summernote({
                height: 300,
                minHeight: null,
                maxHeight: null,
                focus: true,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['insert', ['template', 'codeview']]
                ],
                template: {
                    path: '/luna/tpls',
                    list: [
                        'one-column',
                        'two-columns'
                    ]
                }
            });
        });
    </script>

@endsection
=======
@endsection()
>>>>>>> aa15e913b09cd4e9a1d9cec25811e406f426083c
