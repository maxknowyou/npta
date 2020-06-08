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
        <div class="title-block row">
           
        <div class="col-md-6">
        <h3  style="font-size: 25px;"> Danh sách sách
                    </h3>
                </div>
                <div class="col-md-6 text-right p-t-5">
                <button id="Addbtn" type="button" class="btn ShowPopup btn-primary">Thêm mới</button>
                    <button class="btn btn-primary" style="margin-right: 5px" id="btnCreateAccount">
                            <i class="glyphicon glyphicon-plus"></i> Import Excel
                    </button>
                    <input type="file" style="display:none" id="fileImport">
                </div>
                    
                   
        </div>
        <table class="table table-bordered" id="posts">
            <thead>
                <th>{{__('No.')}}</th>
                <th>Tên</th>
                <th>tác giả</th>
                <th>giá sách</th>
                <th>số lượng</th>
                <th>trạng thái</th>
                <th>tùy chọn</th>
            </thead>
            <tbody></tbody>
        </table>
        <div id="AddModal" class="modal" data-backdrop="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm sách</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tên sách</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="name" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tác giả</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="author" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>giá sách</span>
                    </label>
                    <div class="col-sm-8">

                        <input id="shelf" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>số lượng</span>
                    </label>
                    <div class="col-sm-8">

                        <input id="total" type="email" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Thể loại</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="genre" style="width:100%" class=" js-example-basic-multiple"  multiple="multiple">
  
                    </select>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Mô tả</span>
                    </label>
                    <div class="col-sm-8">

                        <input id="des" type="email" class="form-control" />
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
                        <span>Tên sách</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="nameedit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tác giả</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="authoredit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>giá sách</span>
                    </label>
                    <div class="col-sm-8">

                        <input id="shelfedit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>số lượng</span>
                    </label>
                    <div class="col-sm-8">

                        <input id="totaledit"  class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Thể loại</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="genreedit" style="width:100%" class=" js-example-basic-multiple"  multiple="multiple">
  
                    </select>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Mô tả</span>
                    </label>
                    <div class="col-sm-8">

                        <input id="desedit" type="email" class="form-control" />
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
<form class="hidden" id="ExportCreateAccountTemplate" action="@Url.Action("ExportCreateAccountTemplate")"></form>
</article>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    

    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $('#genreedit').select2();
        LoadListBook();
        LoadGenre();
    });
    function LoadListBook()
    {
        $.ajax({
                type: 'GET',
                url: '/Book/Getlist',
                success: function(result) {
                    initTimeFrameDatatable(JSON.parse(result));
                },
                error: function(error) {
                    alert("Có lỗi xảy ra, vui lòng thử lại", 1);
                }
            });
    }
    function LoadGenre()
    {
        $.ajax({
                type: 'GET',
                url: '/Book/GetGenre',
                success: function(result) {
                   $.each(JSON.parse(result), function (arrayID, element) {
                        $("#genre").append('<option value='+element.id+'>'+element.name+'</option>');
                        $("#genreedit").append('<option value='+element.id+'>'+element.name+'</option>');
                    });
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
                                "<a title='Sửa' class='btn btn-sm btn-primary' onclick='showEditModal(" +
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
                url: '/Book/PrepareEdit',
             data: {
                _token: "{{csrf_token()}}",
                 id: id
             },
             success: function (results) {
                 let result = JSON.parse(results);
                 $("#id").val(result.book.id);
                 $("#nameedit").val(result.book.name);
                 $("#shelfedit").val(result.book.bookshelves);
                 $("#authoredit").val(result.book.author);
                 $("#totaledit").val(result.book.total);
                 $("#desedit").val(result.book.description);
                 $("#genreedit").val(result.gob).change();
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
                url: '/Book/Edit',
                data: {
                    _token: "{{csrf_token()}}",
                    'id':$("#id").val(),
                    'name': $("#nameedit").val(),
                    'author': $("#authoredit").val(),
                    'total': +$("#totaledit").val(),
                    'shelf': +$("#shelfedit").val(),
                    'genre': $("#genreedit").val(),
                    'des':$("#desedit").val(),
                },
                success: function(result) {
                   
                    if (result == 'true') {
                        LoadListBook();
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
    $("#Addbtn").on("click",function(){
        $("#AddModal").modal("show");
    })
      $("#SaveAdd").on("click", function () {
         if ($('#name').val() == "") {
            alert("Vui lòng nhập tên trạng thái");
                return;
            }
           
            $.ajax({
                type: 'POST',
                url: '/Book/Add',
                data: {
                    _token: "{{csrf_token()}}",
                    'name': $("#name").val(),
                    'author': $("#author").val(),
                    'total': +$("#total").val(),
                    'shelf': +$("#shelf").val(),
                    'genre': $("#genre").val(),
                    'des':$("#des").val(),
                },
                success: function(result) {
                    if (result == 'true') {
                        alert('Thêm thành công');
                        LoadListBook();
                        $('#AddModal').modal('hide');
                        ResetAddModal();
                    } else {
                        alert("Thêm thất bại, có lỗi xảy ra");
                    }
                },
                error: function(error) {
                    alert("Có lỗi xảy ra, vui lòng thử lại");
                }
            });
      })
    function Delete(id) {

        var r = confirm("Bạn có muốn khóa tài khoản này?");
            if (r == true) {
                    $.ajax({
                        type: 'POST',
                        url: '/Book/Delete',
                        data: {
                            _token: "{{csrf_token()}}",
                            'id': id,
                        },
                        success: function(data) {
                            if (data == 'true') {
                                alert("Khóa thành công");
                                LoadListBook();
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
    $('#btnCreateAccount').on("click", function (e) {
       
            if (confirm("Bạn đã có mẫu file Excel?")) {
                
                    $('#fileImport').click();
              
} else {
  txt = "You pressed Cancel!";
}
        })

        $('#fileImport').on("change", function (e) { // will trigger each time
            if (this.value != null) {
                var file = $('#fileImport').get(0).files[0];
                var formData = new FormData();
                formData.append('file', file);
                $.ajax({
                    url: "/Import/import",
                    type: "POST",
                    headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (result) {
                        if (result) {
                            alert("Import Excel thành công");
                            setTimeout(function () {
                                window.location.reload()
                            }, 500)                            
                        } else {
                            alert("Import thất bại");
                            setTimeout(function () {
                                window.location.reload()
                            }, 500)
                        }
                    }
                });
            }            
        })
</script>

@endsection
