@extends('luna::admin_layout')

@section('content')

    <h2 class="sub-header">File Manager</h2>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="/admin/file-manager/add" class="btn btn-default">Subir un archivo</a>
                </div>
                <div class="panel-body">
                    <h4>Haz click sobre la imagen para obtener la url pública.</h4>
                    <div class="row">
                        <ul class="thumbnails">
                            @foreach($entries as $entry)
                                <div class="col-md-4">
                                    <div class="thumbnail">
                                        @if($entry->mime == 'image/png' || $entry->mime == 'image/jpeg' || $entry->mime == 'image/jpg')
                                            <img src="{{ '/luna/files/'.$entry->filename }}" alt="" class="img-responsive" />
                                        @else
                                            <h5>No Preview</h5>
                                        @endif
                                        <div class="caption">
                                            <p>{{ $entry->original_filename }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->


@endsection()

@section('extra-js')
    <script>
        $(function() {
            $('.img-responsive').on('click', function(event) {
                event.preventDefault();
                var src = $(this).attr('src');
                window.prompt("Copy to clipboard: Ctrl+C, Enter", src);
            });
        });
    </script>
@endsection