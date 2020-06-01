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
                    <button id="Addbtn" type="button" class="btn ShowPopup btn-primary col-sm-2 offset-sm-10" data-toggle="modal" data-target="#AddModal">Thêm mới</button>
                    
        </div>
        <table class="table table-bordered" id="posts">
            <thead>
                <th>{{__('No.')}}</th>
                <th>Tên</th>
                <th>MSSV</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Thẻ</th>
                <th>Ngày làm thẻ</th>
                <th>Trạng thái</th>
                <th>Tùy chọn</th>
            </thead>
            <tbody></tbody>
        </table>
       
    </div>
    
    <div id="AddModal" class="modal" data-backdrop="true">
            <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm học sinh</h5>
            </div>
            <div class="modal-body text-center p-lg">
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Tên học sinh</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="name" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Hình ảnh</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="file" id="image" class="form-control" onchange="readURL1(this);"/>
                        <div id="formupload" style="padding-bottom:10px;padding-bottom:10px;">
                            <img style="width:150px;height:200px" id="Imganhbia" src="./RootPicture/tenor.gif"  />
                        </div>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Mã số sv</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="code" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Ngày sinh</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="date" id="dob" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Giới tính</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="sex" class="form-control "   style="width:100%;height:initial">
                            <option value="1">Nam</option>
                            <option value="0">Nữ</option>
                        </select>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Loại thẻ</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="card" class="form-control "  style="width:100%;height:initial">
                            
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Ngày bắt đầu</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="date" id="start" class="form-control" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Ngày kết thúc</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="date"  disabled id="end"  class="form-control" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Thoát</button>
                <button type="button" class="btn btn-primary" id="SaveAdd">Thêm</button>
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
                        <span>Tên học sinh</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="nameedit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Hình ảnh</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="file" id="imageedit" class="form-control" onchange="readURL(this);"/>
                        <div id="formupload" style="padding-bottom:10px;padding-bottom:10px;">
                            <img style="width:150px;height:200px" id="Imganhbiaedit" src="./RootPicture/tenor.gif"  />
                        </div>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Mã số sv</span>
                    </label>
                    <div class="col-sm-8">
                        <input id="codeedit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Ngày sinh</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="date" id="dobedit" class="form-control" />
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Giới tính</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="sexedit" class="form-control "   style="width:100%;height:initial">
                            <option value="1">Nam</option>
                            <option value="0">Nữ</option>
                        </select>
                        </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Loại thẻ</span>
                    </label>
                    <div class="col-sm-8">
                    <select id="cardedit" class="form-control "  style="width:100%;height:initial">
                            
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Ngày bắt đầu</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="date" id="startedit" class="form-control" />
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-4 form-control-label">
                        <span>Ngày kết thúc</span>
                    </label>
                    <div class="col-sm-8">
                        <input type="date"  disabled id="endedit"  class="form-control" />
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
    
    $("#Addbtn").on("click",function(){
        $("#AddModal").modal("show");
    })
    $(document).ready(function() {        
        document.getElementById("dob").valueAsDate = new Date();
        document.getElementById("start").valueAsDate = new Date();
        LoadCard();
        LoadCategory();
    });
    function LoadCard()
    {
        $.ajax({
                type: 'GET',
                url: '/Student/GetCard',
                success: function(result) {
                   console.log(JSON.parse(result));
                   $.each(JSON.parse(result), function (arrayID, element) {
                        $("#card").append('<option data-month='+element.validity+' value='+element.id+'>'+element.name+'</option>');
                        $("#cardedit").append('<option data-month='+element.validity+' value='+element.id+'>'+element.name+'</option>');
                    });
                    ChangeEnddayInAddModal($("#card").children("option:selected").data("month"));
                },
                error: function(error) {
                    alert("Có lỗi xảy ra, vui lòng thử lại", 1);
                }
            });
    }
    function ChangeEnddayInAddModal(month)
    {
        let date = $("#start").val().split('-');
        var d = new Date(date[0], date[1], date[2]);
        d.setMonth(d.getMonth() + month-1);
        document.getElementById("end").valueAsDate = d;
    }
    function ChangeEnddayInEditModal(month)
    {
        let date = $("#startedit").val().split('-');
        var d = new Date(date[0], date[1], date[2]);
        d.setMonth(d.getMonth() + month);
        document.getElementById("endedit").valueAsDate = d;
    }
    $("#card").on("change",function(){
        ChangeEnddayInAddModal($(this).data("month"));
    })
    $("#cardedit").on("change",function(){
        ChangeEnddayInEditModal($(this).data("month"));
    })
    function LoadCategory()
    {
        $.ajax({
                type: 'GET',
                url: '/Student/Getlist',
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
                        "aTargets": [7],
                        "mRender": function (data, type, row) {
                            if(data == 1)
                            {
                                return 'Nam';
                            }
                            else
                            {
                                return 'Nữ'
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
                url: '/Student/PrepareEdit',
             data: {
                _token: "{{csrf_token()}}",
                 id: id
             },
             success: function (results) {
                 let result = JSON.parse(results);
                 console.log(result);
                 $("#id").val(result.id);
                 $("#nameedit").val(result.name);
                 $("#codeedit").val(result.code);
                 $("#sexedit").val(result.sex);
                 $("#dobedit").val(result.dob);
                 $("#startedit").val(result.start);
                 $("#endedit").val(result.end);
                 $("#cardedit").val(result.cardid);
                 $("#Imganhbiaedit").prop("src", result.image);
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
            var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('image', $("#imageedit").prop('files')[0]);
            form_data.append('name', $("#nameedit").val());
            form_data.append('code', $("#codeedit").val());
            form_data.append('id', $("#id").val());
            form_data.append('sex', +$("#sexedit").val());
            form_data.append('dob', $("#dobedit").val());
            form_data.append('card', +$("#cardedit").val());
            form_data.append('start',  $("#startedit").val());
            form_data.append('end', $("#endedit").val());
            console.log($("#imageedit").prop('files')[0]);
            $.ajax({
                type: 'POST',
                url: '/Student/Edit',
                headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType:'JSON',
                success: function(result) {
                    console.log(typeof(result));
                    if (result == true) {
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
            var form_data = new FormData();
            //thêm files vào trong form data
            form_data.append('image', $("#image").prop('files')[0]);
            form_data.append('name', $("#name").val());
            form_data.append('code', $("#code").val());
            form_data.append('sex', +$("#sex").val());
            form_data.append('dob', $("#dob").val());
            form_data.append('card', +$("#card").val());
            form_data.append('start',  $("#start").val());
            form_data.append('end', $("#end").val());
            $.ajax({
                type: 'POST',
                url: '/Student/Add',
                headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: form_data,
                cache: false,
                contentType: false,
                processData: false,
                dataType:'JSON',
                success: function(result) {
                    console.log(result);
                    if (result == true) {
                        //alert("Chỉnh sửa thành công");
                        $('#AddModal').modal('hide');
                        LoadCategory();
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
                        url: '/Student/Delete',
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
    function readURL(input) {
                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $("#Imganhbiaedit").prop("src", reader.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            };
            function readURL1(input) {
                if (input.files && input.files[0]) {

                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $("#Imganhbia").prop("src", reader.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            };
</script>

@endsection
