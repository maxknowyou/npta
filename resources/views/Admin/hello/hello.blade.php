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
           
               
                    <h3  style="font-size: 25px;"> {{__('AllCategories')}}
                    </h3>
                    <button type="button" class="btn ShowPopup btn-primary col-sm-2 offset-sm-10" data-toggle="modal" data-target="#AddModal">{{ __('Addnew')}}</button>
                    
        </div>
        <table class="table table-bordered" id="posts">
            <thead>
                <th>{{__('No.')}}</th>
                <th>{{ __('CategoryName')}}</th>
                <th>{{ __('Creator')}}</th>
                <th>{{ __('DateCreated')}}</th>
                <th>{{ __('DateCreated')}}</th>
            </thead>
            <tbody></tbody>
        </table>
        <div id="AddModal" class="modal" data-backdrop="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm thể loại</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tài khoản</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="username" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Mật khẩu</span>
                    </label>
                    <div class="col-sm-8">

                        <input id="pwd" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Email</span>
                    </label>
                    <div class="col-sm-8">

                        <input id="email" type="email" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Loại tài khoản</span>
                    </label>
                    <div class="col-sm-8">
                        <select id="type" class="form-control select2" ui-jp="select2" ui-options="{theme: 'bootstrap'}" style="width:100%">
                            <option value="1">Người dùng</option>
                            <option value="2">Admin</option>
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
                        <span>Tài khoản</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="usernameedit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Mật khẩu</span>
                    </label>
                    <div class="col-sm-8">

                        <input type="password" id="pwdedit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Email</span>
                    </label>
                    <div class="col-sm-8">

                        <input id="emailedit" type="email" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Loại tài khoản</span>
                    </label>
                    <div class="col-sm-8">
                        <select id="roleedit" class="form-control"  style="width:100%">
                            <option value="1">Thủ thư</option>
                            <option value="2">Admin</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="SaveEdit">Thêm</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
{{ csrf_field() }}
</article>
<script>
    $('.ShowPopup').on('click', function(event) {
        var button = $(event.relatedTarget);
        var recipient = button.data('whatever');
        var modal = $(this);
        modal.find('.modal-title').text('New message to ' + recipient);
        modal.find('.modal-body input').val(recipient);
    })

    $(document).ready(function() {
        LoadCategory();
    });
    function LoadCategory()
    {
        $.ajax({
                type: 'GET',
                url: '/GetListCategory',
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
                    "sSearch": "Tìm kiếm:",
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
                        "aTargets": [0, 1,2,3,4],
                        "sClass": "text-center",
                        "bSortable": false
                    },
                    {
                        "aTargets": [3],
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
                        "aTargets": [4],
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
                url: '/Account/PrepareEdit',
             data: {
                _token: "{{csrf_token()}}",
                 id: id
             },
             success: function (results) {
                 let result = JSON.parse(results);
                 $("#id").val(result.id);
                 $("#usernametitle").val(result.username);
                 $("#usernameedit").val(result.username);
                 $("#pwdedit").val(result.password);
                 $("#emailedit").val(result.email);
                 $("#roleedit").val(result.role);
                 
                }
            });
         $('#EditModal').modal('show');

    }
    function ResetEditModal() {
        $("#usernameedit").val("");
                 $("#pwdedit").val("");
                 $("#emailedit").val("");
       
    }
    function ResetAddModal() {
        $("#username").val("");
                 $("#pwd").val("");
                 $("#email").val("");
       
    }
    $("#SaveEdit").on("click", function () {
         if ($('#nameEdit').val() == "") {
            alert("Vui lòng nhập tên thể loại");
                return;
            }
            
            $.ajax({
                type: 'POST',
                url: '/Account/Edit',
                data: {
                    _token: "{{csrf_token()}}",
                    'id': +$("#id").val(),
                    'username': $("#usernameedit").val(),
                    'pwd': +$("#pwdedit").val(),
                    'email': $("#emailedit").val(),
                    'role': $("#roleedit").val(),
                },
                success: function(result) {
                    if (result == 'true') {
                        alert("Chỉnh sửa thành công");
                        $('#EditModal').modal('hide');
                        ResetEditModal();
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
                url: '@Url.Action("Add", "StatusManga")',
                data: {
                    'name': $("#name").val(),
                   
                },
                success: function(result) {
                    if (result.rs == true) {
                        alert(result.mess);
                        loadEmpGroup();
                        $('#AddModal').modal('hide');
                        ResetAddModal();
                    } else {
                        alert(result.mess);
                    }
                },
                error: function(error) {
                    ShowAlert("Có lỗi xảy ra, vui lòng thử lại", 1);
                }
            });
      })
    function Delete(id) {

        var r = confirm("Bạn có muốn khóa này?");
            if (r == true) {
                    $.ajax({
                        type: 'POST',
                        url: '@Url.Action("DeleteStatus", "StatusManga")',
                        data: {
                            'id': id,
                        },
                        success: function(data) {
                            if (data.rs) {
                                alert(data.mess);
                                loadEmpGroup();
                            } else {
                                alert(data.mess);
                            }
                        },
                        error: function (error) {
                            alert(data.mess);
                        }
                    });
}
    }
</script>

@endsection
