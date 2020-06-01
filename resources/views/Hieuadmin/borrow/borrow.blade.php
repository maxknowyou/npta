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
           
               
                    <h3  style="font-size: 25px;"> Danh sách mượn
                    </h3>
                    <button id="Addbtn" type="button" class="btn ShowPopup btn-primary col-sm-2 offset-sm-10" data-toggle="modal" data-target="#AddModal">Thêm mới</button>
                    
        </div>
        <table class="table table-bordered" id="posts">
            <thead>
                <th>{{__('No.')}}</th>
                <th>Tên sinh viên</th>
                <th>Tên sách</th>
                <th>Từ(ngày)</th>
                <th>Đến(ngày)</th>
                <th>Tình trạng</th>
                <th>Ngày trả</th>
                <th>Trạng thái</th>
                <th>Tùy chọn</th>
            </thead>
            <tbody></tbody>
        </table>
        <div id="AddModal" class="modal" data-backdrop="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Sinh viên</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="student" class="form-control "   style="width:100%;height:initial">
                            
                        </select>
                        
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Sách</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="book" style="width:100%" class="js-example-basic-multiple"  multiple="multiple"></select>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Từ ngày</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="date" id="from" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Đến ngày</span>
                    </label>
                    <div class="col-sm-8">
                    <input type="date" id="to" class="form-control" />
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tình Trạng</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="status" class="form-control "   style="width:100%;height:initial">
                            <option value="1">Đang mượn</option>
                            <option value="2">Đã trả</option>
                            <option value="3">Làm mất</option>
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
                        <span>Sinh viên</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="studentedit" class="form-control "   style="width:100%;height:initial">
                            
                        </select>
                        
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Sách</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="bookedit" class="form-control "   style="width:100%;height:initial">
                           
                        </select>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Từ ngày</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="date" id="fromedit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Đến ngày</span>
                    </label>
                    <div class="col-sm-8">
                    <input type="date" id="toedit" class="form-control" />
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tình Trạng</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="statusedit" class="form-control "   style="width:100%;height:initial">
                            <option value="1">Đang mượn</option>
                            <option value="2">Đã trả</option>
                            <option value="3">Làm mất</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Ngày trả</span>
                    </label>
                    <div class="col-sm-8">
                    <input type="date" id="returndayedit" class="form-control" />
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
    
    $("#Addbtn").on("click",function(){
        $("#AddModal").modal("show");
    })
    $(document).ready(function() {    
        document.getElementById("from").valueAsDate = new Date();  
        document.getElementById("returndayedit").valueAsDate = new Date();  
        $('.js-example-basic-multiple').select2();
        LoadDetail();
        LoadCategory();
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
                        $("#student").append('<option data-valday='+element[2]+' value='+element[0]+'>'+element[1]+'</option>');
                        $("#studentedit").append('<option data-valday='+element[2]+' value='+element[0]+'>'+element[1]+'</option>');
                    });
                    ChangeEnddayInAddModal(+$("#student").children("option:selected").data("valday"));
                },
                error: function(error) {
                    alert("Có lỗi xảy ra, vui lòng thử lại", 1);
                }
            });
    }
    function ChangeEnddayInAddModal(day)
    {
        console.log(day);
        let date = $("#from").val().split('-');
        var d = new Date(date[0],+date[1]-1,date[2]);
        let days = d.getDate() + day;
        d.setDate(days);
        document.getElementById("to").valueAsDate = d;    
    }
    function ChangeEnddayInEditModal(day)
    {
        let date = $("#fromedit").val().split('-');
        var d = new Date(date[0], +date[1]-1, date[2]);
        d.setDate(d.getDate() + day);
        document.getElementById("toedit").valueAsDate = d;
    }
    $("#student").on("change",function(){
        ChangeEnddayInAddModal($(this).data("valday"));
    })
    $("#studentedit").on("change",function(){
        ChangeEnddayInEditModal($(this).data("valday"));
    })
    function LoadCategory()
    {
        $.ajax({
                type: 'GET',
                url: '/BorrowList/Getlist',
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
                        "aTargets": [0, 1,2,3,4,5,6,7,8],
                        "sClass": "text-center",
                        "bSortable": false
                    },
                    {
                        "aTargets": [5],
                        "mRender": function (data, type, row) {
                            if(data == 1)
                            {
                                return 'Đang mượn';
                            }
                            else
                            if(data == 2)
                            {
                                return 'Đã trả';
                            }
                            else
                            if(data == 3)
                            {
                                return 'Làm mất';
                            }
                        },
                    },
                    {
                        "aTargets": [7],
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
                        "aTargets": [8],
                        "mRender": function (data, type, row) {
                            var edit =
                                "<a title='Sửa' class='btn btn-sm btn-primary' onclick='showEditModal(" +
                                data +
                                ")'>Sửa</a>";
                            var del =
                                "<a title='Xóa' class='btn btn-sm btn-primary' onclick='Delete(" +
                                data +
                                ")'>Xóa</a>";
                            var returnbook =
                                "<a title='Trả' class='btn btn-sm btn-primary' onclick='Return(" +
                                data +
                                ")'>Trả</a>";
                            var lost =
                                "<a title='Mất' class='btn btn-sm btn-primary' onclick='Lost(" +
                                data +
                                ")'>Mất</a>";
                            return edit+ " " + del + " " + returnbook+ " " + lost;
                        },
                    }
                ],
                "bAutoWidth": false,
            });

    }
    function showEditModal(id) {
         $.ajax({
                type: 'POST',
                url: '/BorrowList/PrepareEdit',
             data: {
                _token: "{{csrf_token()}}",
                 id: id
             },
             success: function (results) {
                 let result = JSON.parse(results);
                 $("#id").val(result.id);
                 $("#studentedit").val(result.studentid);
                 $("#bookedit").val(result.bookid);
                 $("#fromedit").val(result.from);
                 $("#toedit").val(result.to);
                 $("#statusedit").val(result.status);
                 $("#returndayedit").val(result.returnday);
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
                url: '/BorrowList/Edit',
                data: {
                    _token: "{{csrf_token()}}",
                    'id' : $("#id").val(),
                    'student': $("#studentedit").val(),
                    'book': $("#bookedit").val(),
                    'from': $("#fromedit").val(),
                    'to': $("#toedit").val(),
                    'status': $("#statusedit").val(),
                    'returnday': $("#returndayedit").val(),
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
                url: '/BorrowList/Add',
                data: {
                    _token: "{{csrf_token()}}",
                    'student': $("#student").val(),
                    'book': $("#book").val(),
                    'from': $("#from").val(),
                    'to': $("#to").val(),
                    'status': +$("#status").val(),
                   
                },
                success: function(result) {
                    if (result.rs == 'true') {
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
                        url: '/BorrowList/Delete',
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
    function Return(id) {

        var r = confirm("Bạn có muốn trả cuốn sách này?");
            if (r == true) {
            $.ajax({
                type: 'POST',
                url: '/BorrowList/Return',
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
    function Lost(id) {

var r = confirm("Bạn có muốn báo mất cuốn sách này?");
    if (r == true) {
    $.ajax({
        type: 'POST',
        url: '/BorrowList/Lost',
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
