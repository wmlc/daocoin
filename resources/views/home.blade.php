@include('layouts.header')
@include('layouts.left')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            OverView
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>0</h3>

                        <p>Order</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-cart"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>0</h3>

                        <p>Total Amount($US)</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>0</h3>

                        <p>DCP Amount</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-analytics"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>Unconfirmed</h3>

                        <p>AML Check</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-checkmark-round"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">You can conver Fiat to Token to Fiat real time</h3>
            </div>
            <div class="box-body">
                <!-- Split button -->
                <div class="margin">
                    <div class="btn-group">
                        <a href="/buy"><button type="button" class="btn btn-info">Convert Fiat to Token</button></a>
                    </div>
                    <div class="btn-group">
                        <a href="/redeem"><button type="button" class="btn btn-default">Redeem Token to Fiat</button>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success">Trade Token in Exchange</button>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
</div>

@include('layouts.footer')
