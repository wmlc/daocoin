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

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="">ach_check_type</label>
                                    <div class="radio">
                                        <label>
                                            @if(isset($paymentMethod['ach_check_type']) && $paymentMethod['ach_check_type'] == 'personal')
                                                <input type="radio" name="ach_check_type" value="personal" checked> personal
                                            @else
                                                <input type="radio" name="ach_check_type" value="personal"> personal
                                            @endif

                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            @if(isset($paymentMethod['ach_check_type']) && $paymentMethod['ach_check_type'] == 'business')
                                                <input type="radio" name="ach_check_type" value="business" checked> business
                                            @else
                                                <input type="radio" name="ach_check_type" value="business"> business
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">bank-account-name</label>
                                    <input type="text" class="form-control" name="bank_account_name"
                                           value="{{isset($paymentMethod['bank_account_name']) ? $paymentMethod['bank_account_name'] : ''}}"
                                           placeholder="bank-account-name">
                                </div>
                                <div class="form-group">
                                    <label for="">bank-account-type</label>
                                    <div class="radio">
                                        <label>
                                            @if(isset($paymentMethod['bank_account_type']) && $paymentMethod['bank_account_type'] == 'checking')
                                                <input type="radio" name="bank_account_type" value="checking" checked> checking
                                            @else
                                                <input type="radio" name="bank_account_type" value="checking"> checking
                                            @endif
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            @if(isset($paymentMethod['bank_account_type']) && $paymentMethod['bank_account_type'] == 'savings')
                                                <input type="radio" name="bank_account_type" value="savings" checked> savings
                                            @else
                                                <input type="radio" name="bank_account_type" value="savings"> savings
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">bank-account-number</label>
                                    <input type="text" class="form-control" name="bank_account_number"
                                           value="{{isset($paymentMethod['bank_account_number']) ? $paymentMethod['bank_account_number'] : ''}}"
                                           placeholder="bank-account-number">
                                </div>
                                <div class="form-group">
                                    <label for="">contact-name</label>
                                    <input type="text" class="form-control" name="contact_name"
                                           value="{{isset($paymentMethod['contact_name']) ? $paymentMethod['contact_name'] : ''}}"
                                           placeholder="contact-name">
                                </div>
                                <div class="form-group">
                                    <label for="">contact-email</label>
                                    <input type="email" class="form-control" name="contact_email"
                                           value="{{isset($paymentMethod['contact_email']) ? $paymentMethod['contact_email'] : ''}}"
                                           placeholder="contact-email">
                                </div>
                                <div class="form-group">
                                    <label for="">intermediary-bank-name</label>
                                    <input type="text" class="form-control" name="intermediary_bank_name"
                                           value="{{isset($paymentMethod['intermediary_bank_name']) ? $paymentMethod['intermediary_bank_name'] : ''}}"
                                           placeholder="intermediary-bank-name">
                                </div>
                                <div class="form-group">
                                    <label for="">intermediary-bank-reference</label>
                                    <input type="text" class="form-control" name="intermediary_bank_reference"
                                           value="{{isset($paymentMethod['intermediary_bank_reference']) ? $paymentMethod['intermediary_bank_reference'] : ''}}"
                                           placeholder="intermediary-bank-reference">
                                </div>
                                <div class="form-group">
                                    <label for="">payment-type</label>
                                    <div class="radio">
                                        <label>
                                            @if(isset($paymentMethod['payment_type']) && $paymentMethod['payment_type'] == 'ach')
                                                <input type="radio" name="payment_type" value="ach" checked> ach
                                            @else
                                                <input type="radio" name="payment_type" value="ach"> ach
                                            @endif

                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            @if(isset($paymentMethod['payment_type']) && $paymentMethod['payment_type'] == 'check')
                                                <input type="radio" name="payment_type" value="check" checked> check
                                            @else
                                                <input type="radio" name="payment_type" value="check"> check
                                            @endif
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            @if(isset($paymentMethod['payment_type']) && $paymentMethod['payment_type'] == 'credit-card')
                                                <input type="radio" name="payment_type" value="credit-card" checked> credit-card
                                            @else
                                                <input type="radio" name="payment_type" value="credit-card"> credit-card
                                            @endif
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            @if(isset($paymentMethod['payment_type']) && $paymentMethod['payment_type'] == 'wire')
                                                <input type="radio" name="payment_type" value="wire" checked> wire
                                            @else
                                                <input type="radio" name="payment_type" value="wire"> wire
                                            @endif
                                        </label>
                                        &nbsp;&nbsp;
                                        <label>
                                            @if(isset($paymentMethod['payment_type']) && $paymentMethod['payment_type'] == 'wire-international')
                                                <input type="radio" name="payment_type" value="wire-international" checked> wire-international
                                            @else
                                                <input type="radio" name="payment_type" value="wire-international"> wire-international
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">routing-number</label>
                                    <input type="text" class="form-control" name="routing_number"
                                           value="{{isset($paymentMethod['routing_number']) ? $paymentMethod['routing_number'] : ''}}"
                                           placeholder="routing-number">
                                </div>
                                <div class="form-group">
                                    <label for="">swift-code</label>
                                    <input type="text" class="form-control" name="swift_code"
                                           value="{{isset($paymentMethod['swift_code']) ? $paymentMethod['swift_code'] : ''}}"
                                           placeholder="swift-code">

                                </div>
                                <div class="form-group">
                                    <label for="">bank-name</label>
                                    <input type="text" class="form-control" name="bank_name"
                                           value="{{isset($paymentMethod['bank_name']) ? $paymentMethod['bank_name'] : ''}}"
                                           placeholder="bank-name">

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