@extends('luna::admin_layout')

@section('content')

    <h2 class="sub-header">File Manager</h2>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">Subir archivo</div>
                <div class="panel-body">
                    <form action="/admin/file-manager" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Elige un archivo</label>
                                <input type="file" name="file">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="pull-right btn btn-success">Subir Archivo</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection()