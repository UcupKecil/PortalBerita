<script>
    let settings_id;

    const edit = (id) => {
        Swal.fire({
            title: 'Mohon tunggu',
            showConfirmButton: false,
            allowOutsideClick: false,
            willOpen: () => {
                Swal.showLoading()
            }
        });

        settings_id = id;

        $.ajax({
            type: "get",
            url: `/settings/${settings_id}`,
            dataType: "json",
            success: function (response) {
                $('#shortdes').val(response.short_des); //NOTED INI SHORTDES ATAU SHORT_DES
                $("#addressedit").summernote("code", response.address);
                $('#notelp').val(response.phone);
                $('#email').val(response.email);
                $("#layananedit").summernote("code", response.layanan);
                $('#maps').val(response.maps);

                Swal.close();
                $('#editModal').modal('show');
            }
        });
    }

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        $('#addressedit').summernote({
          placeholder: "Ketik disini ....",
          tabsize: 2,
          dialogsInBody: true,
          height: 80
        });

        $('#layananedit').summernote({
            placeholder: "Ketik disini ....",
            tabsize: 2,
            dialogsInBody: true,
            height: 80
        });

        $('#table').DataTable({
                order: [],
                lengthMenu: [[10, 25, 50, 100, -1], ['Sepuluh', 'Salawe', 'lima puluh', 'cepe', 'kabeh']],
                filter: true,
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: '/settings/kumahaaingwe'
                },
                "columns":
                [
                    { data: 'DT_RowIndex', orderable: false, searchable: false},
                    { data: 'short_des', name:'settings.short_des'},
                    { data: 'logo', name:'settings.logo'},
                    { data: 'favicon', name:'settings.favicon'},
                    { data: 'photo', name:'settings.photo'},
                    { data: 'address', name:'settings.address'},
                    { data: 'phone', name:'settings.phone'},
                    { data: 'email', name:'settings.email'},
                    { data: 'layanan', name:'settings.layanan'},
                    { data: 'maps', name:'settings.maps'},
                    { data: 'action', orderable: false, searchable: false},
                ]
            });
        });
</script>
