@extends('admin.master')

@section('content')
<style>
.disabled {
        pointer-events: none;
        cursor: not-allowed;
        opacity: 0.5;
    }
</style>
<div class="sidebar-overlay" id="sidebar-overlay"></div>
<div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
<div class="mobile-menu-handle"></div>
<article class="content items-list-page">
    <div class="title-search-block">
        <div class="title-block">
           
               
                    <h3  style="font-size: 25px;"> Danh sách thẻ
                    </h3>
                    <button type="button" class="btn ShowPopup btn-primary col-sm-2 offset-sm-10" data-toggle="modal" data-target="#AddModal">Thêm mới</button>
                    
        </div>
        <table class="table table-bordered" id="posts">
            <thead>
                <th>{{__('No.')}}</th>
                <th>Tên</th>
                <th>Lượng sách được mượn</th>
                <th>Hiệu lực(tháng)</th>
                <th>Trạng thái</th>
               
                <th>Tùy chọn</th>
            </thead>
            <tbody></tbody>
        </table>
        <div id="AddModal" class="modal" data-backdrop="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm thẻ</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tên thẻ</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="name" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Số sách được mượn</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="totalborrow" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Hiệu lực(tháng)</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="validity" class="form-control" />
                    </div>

                </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="SaveAdd">Thêm</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
    
</div>
<div id="EditModal" class="modal" data-backdrop="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id='usernametitle'></h5>
                <input hidden id="id" class="form-control" />
            </div>
            <div class="modal-body text-center p-lg">
            <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tên thẻ</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="nameedit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Số sách được mượn</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="totalborrowedit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Hiệu lực(tháng)</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="validityedit" class="form-control" />
                    </div>

                </div>
              
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="SaveEdit">Sửa</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
{{ csrf_field() }}
</article>
<script>
    

    $(document).ready(function() {
        LoadCard();
    });
    function LoadCard()
    {
        $.ajax({
                type: 'GET',
                url: '/Card/Getlist',
                success: function(result) {
                    initTimeFrameDatatable(JSON.parse(result));
                },
                error: function(error) {
                    alert("Có lỗi xảy ra, vui lòng thử lại", 1);
                }
            });
    }
    function initTimeFrameDatatable(data) {
            $("#posts").dataTable().fnDestroy();
            $("#posts").dataTable({
                stateSave: true,
                "bFilter": true,
                "bSort": false,
                "data": data,
                "bRetrieve": true,
                "bScrollCollapse": true,
                "bProcessing": true,
                "oLanguage": {
                    "sSearch": "...",
                    "sSearchPlaceholder": "User",
                    "sZeroRecords": "Không có dữ liệu phù hợp",
                    "sInfo": "Hiển thị từ _START_ đến _END_ trên tổng số _TOTAL_ dòng",
                    "sEmptyTable": "Không có dữ liệu",
                    "sInfoFiltered": " - lọc ra từ _MAX_ dòng",
                    "sLengthMenu": "Hiển thị _MENU_ dòng",
                    "sProcessing": "Đang xử lý...",
                    "oPaginate": {
                        "sNext": "<i class='fa fa-chevron-right'></i>",
                        "sPrevious": "<i class='fa fa-chevron-left'></i>"
                    }
                },
                "aoColumnDefs": [
                    {
                        "aTargets": [0, 1,2,3,4,5],
                        "sClass": "text-center",
                        "bSortable": false
                    },
                    {
                        "aTargets": [4],
                        "mRender": function (data, type, row) {
                            if(data == 1)
                            {
                                return '<span class="btn btn-primary disabled">Đang hoạt động</span>';
                            }
                            else
                            {
                                return '<span class="btn btn-warning disabled">Ngưng hoạt động</span>'
                            }
                            
                        },
                    },
                    {
                        "aTargets": [5],
                        "mRender": function (data, type, row) {
                            var edit =
                                "<a title='Xóa' class='btn btn-sm btn-primary' onclick='showEditModal(" +
                                data +
                                ")'>Sửa</a>";
                            var del =
                                "<a title='Xóa' class='btn btn-sm btn-primary' onclick='Delete(" +
                                data +
                                ")'>Xóa</a>";
                            return edit+ " " + del ;
                        },
                    }
                ],
                "bAutoWidth": false,
            });

    }
    function showEditModal(id) {
         $.ajax({
                type: 'POST',
                url: '/Card/PrepareEdit',
             data: {
                _token: "{{csrf_token()}}",
                 id: id
             },
             success: function (results) {
                 let result = JSON.parse(results);
                 $("#id").val(result.id);
                 $("#nameedit").val(result.name);
                 $("#totalborrowedit").val(result.totalborrow);
                 $("#validityedit").val(result.validity);
                }
            });
         $('#EditModal').modal('show');

    }
    function ResetEditModal() {
        $("#name").val("");
                
       
    }
    function ResetAddModal() {
        $("#name").val("");
                
       
    }
    $("#SaveEdit").on("click", function () {
         if ($('#nameedit').val() == "") {
            alert("Vui lòng nhập tên thể loại");
                return;
            }
            
            $.ajax({
                type: 'POST',
                url: '/Card/Edit',
                data: {
                    _token: "{{csrf_token()}}",
                    'id': +$("#id").val(),
                    'name': $("#nameedit").val(),
                    'totalborrow': $("#totalborrowedit").val(),
                    'validity': $("#validityedit").val(),
                   
                },
                success: function(result) {
                    if (result == 'true') {
                        alert("Chỉnh sửa thành công");
                        $('#EditModal').modal('hide');
                        ResetEditModal();
                        LoadCard();
                    } else {
                        alert("Có lỗi xảy ra, vui lòng thử lại");
                    }
                },
                error: function(error) {
                    alert("Có lỗi xảy ra, vui lòng thử lại");
                }
            });
    })
      $("#SaveAdd").on("click", function () {
         if ($('#name').val() == "") {
            alert("Vui lòng nhập tên trạng thái");
                return;
            }
           
            $.ajax({
                type: 'POST',
                url: '/Card/Add',
                data: {
                    _token: "{{csrf_token()}}",
                    'name': $("#name").val(),
                    'totalborrow': $("#totalborrow").val(),
                    'validity': $("#validity").val(),
                    
                   
                },
                success: function(result) {
                    if (result.rs == 'true') {
                        alert("Thêm thành công");
                        LoadCard();
                        $('#AddModal').modal('hide');
                        ResetAddModal();
                    } else {
                        alert("Thêm thành công");
                    }
                },
                error: function(error) {
                    alert("Có lỗi xảy ra, vui lòng thử lại", 1);
                }
            });
      })
    function Delete(id) {

        var r = confirm("Bạn có muốn khóa thể loại này?");
            if (r == true) {
                    $.ajax({
                        type: 'POST',
                        url: '/Card/Delete',
                        data: {
                            _token: "{{csrf_token()}}",
                            'id': id,
                        },
                        success: function(data) {
                            if (data == 'true') {
                                alert("Khóa thành công");
                                LoadCard();
                            } else {
                                alert('Có lỗi đã xảy ra, vui lòng liên hệ admin');
                            }
                        },
                        error: function (error) {
                            alert('Có lỗi đã xảy ra, vui lòng liên hệ admin');
                        }
                    });
}
    }
</script>

@endsection
