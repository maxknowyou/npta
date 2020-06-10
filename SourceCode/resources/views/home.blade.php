@extends('admin.master')

@section('content')
<div class="sidebar-overlay" id="sidebar-overlay"></div>
<div class="sidebar-mobile-menu-handle" id="sidebar-mobile-menu-handle"></div>
<div class="mobile-menu-handle"></div>
<article class="content dashboard-page">
    <section class="section">
        <div class="row sameheight-container">
            <div class="col col-12 col-sm-12 col-md-6 col-xl-5 stat-col">
                <div class="card sameheight-item" data-exclude="xs">
                    <div class="card-header card-header-sm bordered">
                        <div class="header-block">
                            <h3 class="title" style="font-size: 20px;">Tổng số sách: <span id="TotalBook"></span> cuốn</h3>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="form-group ">
                            <div class="row stat-icon">
                                <i class="fa fa-shopping-cart pl-1 pt-1 pr-1"></i>
                                <div class="name">Sách đang mượn</div>
                            </div>
                            <div class="stat">
                                <div class="value"> <span id="BorrowBook"></span> cuốn</div>
                            </div>
                            <div class="progress stat-progress">
                                <div class="progress-bar" id="BorrowBookbar"
                                    style="width: 100%;"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row stat-icon">
                                <i class="fa fa-users pl-1 pt-1 pr-1"></i>
                                <div class="name">Sách làm mất</div>
                            </div>
                            <div class="stat">
                            <div class="value"> <span id="LostBook"></span> cuốn</div>
                            </div>
                            <div class="progress stat-progress">
                                <div class="progress-bar" id="LostBookbar"
                                    style="width: 10%;">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row stat-icon">
                                <i class="fa fa-line-chart pl-1 pt-1 pr-1"></i>
                                <div class="name">Sách còn lại</div>
                            </div>
                            <div class="stat">
                                <div class="value">
                                <div class="value"> <span id="Book"></span> cuốn</div>
                                </div>
                            </div>
                            <div class="progress stat-progress">
                                <div class="progress-bar" id="Bookbar"
                                    style="width: 10%;">
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="col col-12 col-sm-12 col-md-6 col-xl-7 history-col">
                <div class="card sameheight-item" data-exclude="xs" id="dashboard-history">
                    <div class="card-header card-header-sm bordered">
                        <div class="header-block">
                            <h3 class="title" style="font-size: 20px;">Sách mượn và mất theo tháng</h3>
                        </div>
                    </div>
                    <div class="card-block h-100" id='canvas-container'>
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
</article>

<script>
$(document).ready(function() {
    LoadNumber();
    });
var ctx = document.getElementById('myChart').getContext('2d');
var ctx = document.getElementById('myChart');

function LoadNumber()
{
    $.ajax({
                type: 'GET',
                url: '/home/getinfo',
                
                success: function(result) {
                    console.log(result);
                    var res = JSON.parse(result);
                    console.log(res);
                    $("#TotalBook").text(res.total);
                    $("#BorrowBook").text(res.borrow);
                    $("#LostBook").text(res.lost);
                    $("#Book").text(res.active);
                    $("#BorrowBookbar").css("width",res.borrow/res.total*100 +"%");
                    $("#LostBookbar").css("width",res.lost/res.total*100 + "%");
                    $("#Bookbar").css("width",res.active/res.total*100 + "%");
                   
                    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9','10','11','12'],
        datasets: [{
            label: 'Sách mượn',
            data: res.borrowyear,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)'
                
            ],
            borderColor: [
               
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)'
            
            ],
            borderWidth: 1
        },
        {
            label: 'Sách mất',
            data: res.lostyear,
            backgroundColor: [
                
                
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)'
               
            ],
            borderColor: [
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(255, 206, 86, 0.2)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
                },
                error: function(error) {
                    alert("Có lỗi xảy ra, vui lòng thử lại", 1);
                }
            });
}
</script>
@endsection