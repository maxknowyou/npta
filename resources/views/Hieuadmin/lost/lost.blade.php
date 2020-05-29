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
           
               
                    <h3  style="font-size: 25px;"> Danh sách tài khoản
                    </h3>
                    <button type="button" class="btn ShowPopup btn-primary col-sm-2 offset-sm-10" data-toggle="modal" data-target="#AddModal">Thêm mới</button>
                    
        </div>
        <table class="table table-bordered" id="posts">
            <thead>
                <th>{{__('No.')}}</th>
                <th>Tên sinh viên</th>
                <th>Sách bị mất</th>
                <th>Ngày mất</th>
                <th>Xử lý</th>
                <th>Trạng thái</th>
                <th>Tùy chọn</th>
            </thead>
            <tbody></tbody>
        </table>
        <div id="AddModal" class="modal" data-backdrop="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm sách mất</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tên sinh viên</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="student" class="form-control "   style="width:100%;height:initial">
                            
                            </select>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tên sách</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="book" style="width:100%" class="js-example-basic-multiple"  multiple="multiple"></select>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Ngày mất</span>
                    </label>
                    <div class="col-sm-8">
                        <input type='date' id="time" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Xử lý</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="status" class="form-control "   style="width:100%;height:initial">
                        <option value="1">Chờ xử lý</option>
                            <option value="2">Đã xử lý</option>
                    </select>
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
                        <span>Tên sinh viên</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="studentedit" class="form-control "   style="width:100%;height:initial">
                            
                            </select>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tên sách</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="bookedit" class="form-control "   style="width:100%;height:initial">
                            
                            </select>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Ngày mất</span>
                    </label>
                    <div class="col-sm-8">
                        <input type='date' id="timeedit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Xử lý</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="statusedit" class="form-control "   style="width:100%;height:initial">
                        <option value="1">Chờ xử lý</option>
                            <option value="2">Đã xử lý</option>
                    </select>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    

    $(document).ready(function() {
        document.getElementById("time").valueAsDate = new Date();
        document.getElementById("timeedit").valueAsDate = new Date();
        $('.js-example-basic-multiple').select2();
        LoadCategory();
        LoadDetail();
    });
    function LoadDetail()
    {
        $.ajax({
                type: 'GET',
                url: '/BorrowList/Getdetail',
                success: function(result) {
                    var res = JSON.parse(result);
                   console.log(JSON.parse(result));
                   $.each(res.book, function (arrayID, element) {
                        $("#book").append('<option value='+element.id+'>'+element.name+'</option>');
                        $("#bookedit").append('<option value='+element.id+'>'+element.name+'</option>');
                    });
                    $.each(res.student, function (arrayID, element) {
                        $("#student").append('<option  value='+element[0]+'>'+element[1]+'</option>');
                        $("#studentedit").append('<option  value='+element[0]+'>'+element[1]+'</option>');
                    });
                },
                error: function(error) {
                    alert("Có lỗi xảy ra, vui lòng thử lại", 1);
                }
            });
    }
    function LoadCategory()
    {
        $.ajax({
                type: 'GET',
                url: '/LostList/Getlist',
                success: function(result) {
                    initTimeFrameDatatable(JSON.parse(result));
                   console.log(JSON.parse(result));
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
                        "aTargets": [0, 1,2,3,4,5,6],
                        "sClass": "text-center",
                        "bSortable": false
                    },
                    {
                        "aTargets": [4],
                        "mRender": function (data, type, row) {
                            if(data == 1)
                            {
                                return 'Chờ xử lý';
                            }
                            else
                            {
                                return 'Đã xử lý'
                            }
                            
                        },
                    },
                    {
                        "aTargets": [5],
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
                        "aTargets": [6],
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
                url: '/LostList/PrepareEdit',
             data: {
                _token: "{{csrf_token()}}",
                 id: id
             },
             success: function (results) {
                 let result = JSON.parse(results);
                 $("#id").val(result.id);
                 $("#studentedit").val(result.studentid);
                 $("#bookedit").val(result.bookid);
                 $("#statusedit").val(result.status);
                 $("#timeedit").val(result.time);
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
                url: '/LostList/Edit',
                data: {
                    _token: "{{csrf_token()}}",
                    'id': +$("#id").val(),
                    'student': $("#studentedit").val(),
                    'book': $("#bookedit").val(),
                    'status': $("#statusedit").val(),
                    'time': $("#timeedit").val(),
                },
                success: function(result) {
                    if (result == 'true') {
                        alert("Chỉnh sửa thành công");
                        $('#EditModal').modal('hide');
                        ResetEditModal();
                        LoadCategory();
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
                url: '/LostList/Add',
                data: {
                    _token: "{{csrf_token()}}",
                    'student': $("#student").val(),
                    'book': $("#book").val(),
                    'status': $("#validity").val(),
                    'time': $("#time").val(),
                   
                },
                success: function(result) {
                    if (result == 'true') {
                        alert("Thêm thành công");
                        LoadCategory();
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
                        url: '/LostList/Delete',
                        data: {
                            _token: "{{csrf_token()}}",
                            'id': id,
                        },
                        success: function(data) {
                            if (data == 'true') {
                                alert("Khóa thành công");
                                LoadCategory();
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
