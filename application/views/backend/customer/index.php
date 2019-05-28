<section class="content-header">
    <div class="content-header-icon">
        <i class="fa fa-list"></i>
    </div>
    <h1>
        Customer <br>
        <small>Customer List</small>
    </h1>
    <div class="content-header-action">
        <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-upload" data-backdrop="static" data-keyboard="false"> <i class="fa fa-upload fa-sm fa-mr"></i> Import</button> -->
        <a href="<?php echo BASE_URL('customer/create'); ?>" class="btn btn-success"><i class="fa fa-plus fa-sm fa-mr"></i> Tambah</a>
    </div>
</section>

<section class="content">
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">List</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered data-table" id="table-order">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Status</th>
                                <th>Kode</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <!-- <th>Jenis Kelamin</th> -->
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach ($customer as $row) {
                        ?>
                            <tr id="<?php echo $row->customer_id; ?>">
                            <td width="8%">
                                    <!-- <div class="btn-group">
                                        <button type="button" class="btn btn-sm dropdown-toggle bg-teal" data-toggle="dropdown">
                                            <span class="fa fa-caret-down"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo BASE_URL()."customer/detail/".$row->customer_id; ?>"><i class="fa fa-eye"></i> View</a></li>
                                            <li><a href="<?php echo BASE_URL()."customer/edit/".$row->customer_id; ?>"><i class="fa fa-pencil"></i> Edit</a></li>
                                            <li><a href="#" class="delete" id="<?php echo $row->customer_id; ?>"><i class="fa fa-trash"></i> Delete</a></li>
                                        </ul>
                                    </div> -->
                                    <a href="<?php echo BASE_URL()."customer/edit/".$row->customer_id; ?>" class="btn btn-sm bg-purple"><i class="fa fa-pencil"></i></a>&nbsp;&nbsp;
                                    <a href="#" id="<?php echo $row->customer_id; ?>" class="btn btn-sm bg-red delete"><i class="fa fa-trash"></i></a>
                                </td>
                                <td><?php echo $row->customer_status; ?></td>
                                <td><?php echo $row->customer_code; ?></td>
                                <td><?php echo $row->customer_nama; ?></td>
                                <td><?php echo $row->customer_email; ?></td>
                                <td><?php echo $row->customer_phone; ?></td>
                                <!-- <td><?php echo $row->customer_gender; ?></td> -->
                            </tr>
                        <?php
                            }  
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</section>



<script type="text/javascript">
    $(document).ready(function(){
        var actions = 0;
        var new_row = $("<tr class='search-header'/>");
        $('.data-table thead th').each(function(i){
            var title = $(this).text();
            var new_th = $('<th style ="' + $(this).attr('style') + '"/>');

            if (title != '') {
                $(new_th).append('<input type="text" class="form-control" style="width:100%" placeholder="' + title + '" data-index="' + i + '"/>');
                $(new_row).append(new_th);
            } else {
                actions = 1;
                $(new_row).append(new_th);
            }
        });
        $('.data-table thead').prepend(new_row);

        var orderable = true;
        if (actions > 0) {
            orderable = false;
        }

        var table = $('.data-table').DataTable({
            paging:true,
            ordering:true,
            seraching:true,
            info:true,
            scrollX:true,
            "order":[[ actions, "asc" ]],
            "columnDefs": [
                { "orderable" : orderable, "targets" : 0 }
            ]
        });
        $('.dataTables_filter').hide();
        $('.dataTables_scrollHeadInner').css('width','100%');
        $('.data-table').css('width','100%');

        $(table.table().container()).on('keyup', 'thead input', function(){
            table
            .column($(this).data('index'))
            .search(this.value)
            .draw();
        });
    });
</script>

<script type="text/javascript">
    $(".delete").click(function(){
        var id = $(this).attr("id");
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this customer!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if(willDelete) {
                $.ajax({
                    url: '<?php BASE_URL()?>customer/delete/'+id,
                    type: 'DELETE',
                    dataType: 'json',
                    error: function(){
                        alert('Something is wrong');
                    },
                    success: function(data) {
                        if(data.status == 'success'){
                            $("#"+id).remove();
                            swal("Deleted!", "Your customer has been deleted.", "success");
                            
                        }
                        else {
                            swal("Cancelled", "Error delete data", "error");
                        }
                        
                    }
                });
            }
            else {
                swal("Cancelled", "Your customer is safe :)", "error");
            }
        });
     
    });
    
</script>