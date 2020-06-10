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
           
               
                    <h3  style="font-size: 25px;"> {{__('ListUser')}}
                    </h3>
                    <button id="Addbtn" type="button" class="btn  btn-primary col-sm-2 offset-sm-10">Thêm mới</button>
                    
        </div>
        <table class="table table-bordered" id="posts">
            <thead>
                <th>{{__('No.')}}</th>
                <th>{{__('UserName')}}</th>
                <th>{{__('Email')}}</th>
                <th>{{__('Type')}}</th>
                <th>{{__('Active')}}</th>
                <th>{{__('Option')}}</th>
            </thead>
            <tbody></tbody>
        </table>
        <div id="AddModal" class="modal" data-backdrop="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{__('AddnewUser')}}</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>{{__('UserName')}}</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="username" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>{{__('Pwd')}}</span>
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
                        <span>{{__('Type')}}</span>
                    </label>
                    <div class="col-sm-8">
                        <select id="role" class="form-control select2" ui-jp="select2" ui-options="{theme: 'bootstrap'}" style="width:100%">
                            <option value="1">{{__('Librarian')}}</option>
                            <option value="2">{{__('Admin')}}</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('Cancel')}}</button>
                <button type="button" class="btn btn-primary" id="SaveAdd">{{__('Add new')}}</button>
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
                        <span>{{__('UserName')}}</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="usernameedit" class="form-control" />
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
                        <span>{{__('Type')}}</span>
                    </label>
                    <div class="col-sm-8">
                        <select id="roleedit" class="form-control"  style="width:100%">
                            <option value="1">{{__('Librarian')}}</option>
                            <option value="2">{{__('Admin')}}</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">{{__('Cancel')}}</button>
                <button type="button" class="btn btn-primary" id="SaveEdit">{{__('Save')}}</button>
            </div>
        </div><!-- /.modal-content -->
    </div>
{{ csrf_field() }}
</article>
<script>
   
   $("#Addbtn").on("click",function(){
        $("#AddModal").modal("show");
    })
    $(document).ready(function() {
        LoadUser();
    });
    function LoadUser()
    {
        $.ajax({
                type: 'GET',
                url: '/Account/Getlist',
                success: function(result) {
                    initTimeFrameDatatable(JSON.parse(result));
                },
                error: function(error) {
                    Console.log("Something wrong with get data for table user, checkout /Getlist", 1);
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
                        "aTargets": [3],
                        "mRender": function (data, type, row) {
                            if(data == 1)
                            {
                                return '{{__("Librarian")}}';
                            }
                            else
                            {
                                return '{{__("Admin")}}';
                            }
                            
                        },
                    },
                    {
                        "aTargets": [4],
                        "mRender": function (data, type, row) {
                            if(data == 1)
                            {
                                return '<span class="btn btn-primary disabled">{{__("BeActive")}}</span>';
                            }
                            else
                            {
                                return '<span class="btn btn-warning disabled">{{__("Deactive")}}</span>'
                            }
                            
                        },
                    },
                    {
                        "aTargets": [5],
                        "mRender": function (data, type, row) {
                            var edit =
                                "<a title='Xóa' class='btn btn-sm btn-primary' onclick='showEditModal(" +
                                data +
                                ")'>{{__('Edit')}}</a>";
                            var del =
                                "<a title='Xóa' class='btn btn-sm btn-primary' onclick='Delete(" +
                                data +
                                ")'>{{__('Del')}}</a>";
                                var active =
                                "<a title='Xóa' class='btn btn-sm btn-primary' onclick='ActiveUser(" +
                                data +
                                ")'>Mở</a>";
                            return edit+ " " + del + " " + active;
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
                 $("#usernametitle").val(result.name);
                 $("#usernameedit").val(result.name);
                 
                 $("#emailedit").val(result.email);
                 $("#roleedit").val(result.role);
                },
                error: function(error) {
                    Console.log("Something wrong with get data for one user, checkout /Account/PrepareEdit", 1);
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
    function CheckInputEdit()
    {
        if ($('#nameedit').val() == "") {
            alert("Vui lòng nhập tài khoản");
                return;
            }
            if ($('#pwdedit').val() == "") {
            alert("Vui lòng nhập mật khẩu");
                return;
            }
            if ($('#emailedit').val() == "") {
            alert("Vui lòng nhập email");
                return;
            }
    }
    function CheckInputAdd()
    {
        if ($('#name').val() == "") {
            alert("Vui lòng nhập tài khoản");
                return;
            }
            if ($('#pwd').val() == "") {
            alert("Vui lòng nhập mật khẩu");
                return;
            }
            if ($('#email').val() == "") {
            alert("Vui lòng nhập email");
                return;
            }
    }
    $("#SaveEdit").on("click", function () {
        CheckInputEdit();
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
                        LoadUser();
                    } else {
                        alert("Something wrong with edit data for one user, checkout /Account/Edit", 1);
                    }
                },
                error: function(error) {
                    alert("Something wrong with edit data for one user, checkout /Account/Edit", 1);
                }
            });
    })
      $("#SaveAdd").on("click", function () {
        CheckInputAdd();
           
            $.ajax({
                type: 'POST',
                url: '/Account/Add',
                data: {
                    _token: "{{csrf_token()}}",
                    'username': $("#username").val(),
                    'pwd': $("#pwd").val(),
                    'email': $("#email").val(),
                    'role': $("#role").val(),
                },
                success: function(result) {
                    if (result == 'true') {
                        alert("Thêm thành công");
                        LoadUser();
                        $('#AddModal').modal('hide');
                        ResetAddModal();
                    } else {
                        alert("Something wrong with add user, checkout /Account/Add", 1);
                    }
                },
                error: function(error) {
                    alert("Something wrong with add user, checkout /Account/Add", 1);
                }
            });
      })
    function Delete(id) {

        var r = confirm("Bạn có muốn khóa tài khoản này?");
            if (r == true) {
                    $.ajax({
                        type: 'POST',
                        url: '/Account/Delete',
                        data: {
                            _token: "{{csrf_token()}}",
                            'id': id,
                        },
                        success: function(data) {
                            if (data == 'true') {
                                alert("Khóa thành công");
                                LoadUser();
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
    function ActiveUser(id) {

var r = confirm("Bạn có muốn mở khóa tài khoản này?");
    if (r == true) {
            $.ajax({
                type: 'POST',
                url: '/Account/ActiveUser',
                data: {
                    _token: "{{csrf_token()}}",
                    'id': id,
                },
                success: function(data) {
                    if (data == 'true') {
                        alert("Mở khóa thành công");
                        LoadUser();
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
