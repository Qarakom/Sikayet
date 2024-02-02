@extends('layouts.app')
@section('style')
<link href="{{ url('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

  <!-- Page Heading -->
  <div class="row mb-2">
  <div class="col-md-6">
    <h1 class="h3 mb-2 text-gray-800">Şikayətlər</h1>
  </div>
  <div class="col-md-6 pull-right">
    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#sikayetElave" ><i class="fas fa-plus"></i> Yeni Şikayət</a>
  </div>
</div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Siyahı</h6>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Şikayətçi</th>
                          <th>Operator</th>
                          <th>Mövzu</th>
                          <th>Şikayət Tarixi</th>
                          <th>Əməliyatlar</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                        <th>Şikayətçi</th>
                        <th>Operator</th>
                        <th>Mövzu</th>
                        <th>Şikayət Tarixi</th>
                        <th>Əməliyatlar</th>
                      </tr>
                  </tfoot>
                  <tbody>



                  </tbody>
              </table>
          </div>
      </div>
  </div>
@endsection

@section('modal')
@include('pages.modals.sikayetElave');
@include('pages.modals.sikayetBaxis');
@endsection

@section('script')
<script src="{{ url('vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<script type="text/javascript">

$(document).ready(function(){

$('#dataTable').DataTable({
    processing: true,
    serverside: true,
    ajax: {
        url:"{{ route('sikayet.list') }}"
    },
    columns: [
        { data: 'sikayetcil.name' },
        { data: 'operator.ad' },
        { data: 'movzu' },
        { data: 'created_at' },
        { data: 'id',

        render: function(data, type, full, meta) {
            return '<div class="btn-group btn-group-sm" role="group" aria-label="Əməliyatlar">'+
                '<a href="#" data-sikayet-id="'+data+'" class="btn btn-info sikayetBaxisBtn"><i class="fas fa-search"></i></a>'+
                '<a href="#" data-sikayet-id="'+data+'" class="btn btn-warning"><i class="far fa-edit"></i></a>'+
                '<a href="#" data-sikayet-id="'+data+'" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>'+
                '</div>';
        }
        }
    ],
    initComplete: function () {
        this.api().columns().every(function () {
            var column = this;
            var header = $(column.header());
            var input = $('<input type="text" class="form-control" placeholder="Search"/>')
                .appendTo($(header))
                .on('keyup change', function () {
                    column.search($(this).val(), false, false, true).draw();
                });
        });
    }
  });

        $('#sikayetElave').on('submit', function(e){
        e.preventDefault();
        let formData = {
                movzu: $('#movzu').val(),
                metn: $('#metn').val(),
                operator_id: $('#operator').val(),
            };

          $.ajax({
            url: "{{ route('sikayet.elave') }}",
            data: formData,
            type: 'post',
            success:function(data){
                alert('Elave edildi');
            }
           })
        });


        $('body').on('click', '.sikayetBaxisBtn', function(e) {
            e.preventDefault();
            let sikayetId = $(this).data('sikayet-id');

        $.ajax({
            url: '{{ route('sikayet.list') }}/' + sikayetId,
            type: 'GET',
            success: function (data) {
                // Populate modal with sikayet details

                $('#sikayetBaxisBasliq').text(data.movzu);
                $('#sikayetci_td').text(data.sikayetcil.name);
                $('#operator_td').text(data.operator.ad);
                $('#movzu_td').text(data.movzu);
                $('#metn_td').text(data.metn);

                // Show the modal
                $('#sikayetBaxis').modal('show');
            },
            error: function (error) {
                console.log(error);
            }
        });
    });



    });

    </script>
@endsection
