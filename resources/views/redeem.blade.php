@include('layouts.header')
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@include('layouts.left')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Redeem Order List
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>createTime</th>
                                <th>order id</th>
                                <th>order status</th>
                                <th>order currency</th>
                                <th>order amount</th>
                                <th>token name</th>
                                <th>token amount</th>
                                <th>txhash</th>
                                <th>primetrust redeem id</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($redeemList as $key => $val)
                                <tr>
                                    <td>{{$val['created_at']}}</td>
                                    <td>{{$val['redeem_id']}}</td>
                                    <td>{{$val['redeem_status']}}</td>
                                    <td>{{$val['redeem_currency']}}</td>
                                    <td>{{$val['redeem_amount']}}</td>
                                    <td>{{$val['token_name']}}</td>
                                    <td>{{$val['token_amount']}}</td>
                                    <td>{{$val['orderHash']}}</td>
                                    <td>{{$val['primetrust_redeem_id']}}</td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $redeemList->links()}}
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
</div>

@include('layouts.footer')

<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
