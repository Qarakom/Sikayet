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
                '<a href="#" class="btn btn-info"><i class="fas fa-search"></i></a>'+
                '<a href="#" class="btn btn-warning"><i class="far fa-edit"></i></a>'+
                '<a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>'+
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

    });
