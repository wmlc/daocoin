@include('layouts.header')
@include('layouts.left')
<div class="wrapper">


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                set payment method
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-md-12">

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 style="padding: 20px 10px;" class="box-title">
                                <i style="color:#dd4b39;" class="fa fa-warning"></i> It is detected that you have not
                                                                                     bound the ERC20 address, please
                                                                                     bind immediatedly!</h3>
                            <h3 style="padding: 0 10px 30px 10px;" class="box-title">Binding bank information is the way
                                                                                     you redeem the receipt of the
                                                                                     currency. The system only supports
                                                                                     binding once and cannot be changed.
                                                                                     Please be sure to fill it in
                                                                                     correctil!</h3>
                        </div>

                        <form role="form" action="/setPaymentMethod" method="post">
                            @csrf
                            <div class="box-body" style="padding:20px;">

                                <div class="form-group">
                                    <label for="">ach_check_type</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="ach_check_type" value="personal" checked> personal
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="ach_check_type" value="business"> business
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">bank-account-name</label>
                                    <input type="text" class="form-control" name="bank_account_name" placeholder="bank-account-name">
                                </div>
                                <div class="form-group">
                                    <label for="">bank-account-type</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="bank_account_type" value="checking" checked>
                                            checking
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="bank_account_type" value="savings"> savings
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">bank-account-number</label>
                                    <input type="text" class="form-control" name="bank_account_number"
                                           placeholder="bank-account-number">
                                </div>
                                <div class="form-group">
                                    <label for="">contact-name</label>
                                    <input type="text" class="form-control" name="contact_name"
                                           placeholder="contact-name">
                                </div>
                                <div class="form-group">
                                    <label for="">contact-email</label>
                                    <input type="email" class="form-control" name="contact_email"
                                           placeholder="contact-email">
                                </div>
                                <div class="form-group">
                                    <label for="">intermediary-bank-name</label>
                                    <input type="text" class="form-control" name="intermediary_bank_name"
                                           placeholder="intermediary-bank-name">
                                </div>
                                <div class="form-group">
                                    <label for="">intermediary-bank-reference</label>
                                    <input type="text" class="form-control" name="intermediary_bank_reference"
                                           placeholder="intermediary-bank-reference">
                                </div>
                                <div class="form-group">
                                    <label for="">payment-type</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="payment_type" value="ach" checked> ach
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="payment_type" value="check"> check
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="payment_type" value="credit-card"> credit-card
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="payment_type" value="wire"> wire
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            <input type="radio" name="payment_type" value="wire-international">
                                            wire-international
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">routing-number</label>
                                    <input type="text" class="form-control" name="routing_number"
                                           placeholder="routing-number">
                                </div>
                                <div class="form-group">
                                    <label for="">swift-code</label>
                                    <input type="text" class="form-control" name="swift_code" placeholder="swift-code">
                                </div>
                                <div class="form-group">
                                    <label for="">bank-name</label>
                                    <input type="text" class="form-control" name="bank_name" placeholder="bank-name">
                                </div>

                            </div>
                            <div class="box-footer" style="padding:20px 20px 30px;">
                                <button style="padding:10px 40px;" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>


                </div>

                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>


</div>
@include('layouts.footer')