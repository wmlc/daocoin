@include('layouts.header')
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@include('layouts.left')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Purchase Order List
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
                                <th>memo code</th>
                                <th>order status</th>
                                <th>order currency</th>
                                <th>order amount</th>
                                <th>wallet address</th>
                                <th>token name</th>
                                <th>token amount</th>
                                <th>purchase fee</th>
                                <th>purchase rate</th>
                                <th>dcp in return</th>
                                <th>purchase method</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orderList as $key => $val)
                                <tr>
                                    <td>{{$val['created_at']}}</td>
                                    <td>{{$val['order_id']}}</td>
                                    <td>{{$val['mem_code']}}</td>
                                    <td>{{$val['order_status']}}</td>
                                    <td>{{$val['order_currency']}}</td>
                                    <td>{{$val['order_amount']}}</td>
                                    <td>{{$val['wallet_address']}}</td>
                                    <td>{{$val['token_name']}}</td>
                                    <td>{{$val['token_amount']}}</td>
                                    <td>{{$val['purchase_fee']}}</td>
                                    <td>{{$val['purchase_rate']}}</td>
                                    <td>{{$val['dcp_in_return']}}</td>
                                    <td>{{$val['purchase_method']}}</td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $orderList->links()}}
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
