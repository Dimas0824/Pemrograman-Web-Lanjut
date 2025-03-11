@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools">
                <a class="btn btn-sm btn-primary mt-1" href="{{ url('suplier/create') }}">Tambah</a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" id="suplier_id" name="suplier_id">
                                <option value="">- Semua -</option>
                                @foreach ($suplier as $item)
                                    <option value="{{ $item->suplier_id }}">{{ $item->nama_suplier }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Pilih suplier</small>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped table-hover table-sm" id="table_suplier">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Suplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            var datasuplier = $('#table_suplier').DataTable({
                serverSide: true,
                ajax: {
                    "url": "{{ url('suplier/list') }}",
                    "dataType": "json",
                    "type": "GET",
                    "data": function(d) {
                        d.suplier_id = $('#suplier_id').val();
                    }
                },
                columns: [{
                        data: "suplier_id",
                        className: "text-center"
                    },
                    {
                        data: "nama_suplier"
                    },
                    {
                        data: "aksi",
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#suplier_id').on('change', function() {
                datasuplier.ajax.reload();
            });
        });
    </script>
@endpush
