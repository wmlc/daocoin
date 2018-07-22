@include('layouts.header')
@include('layouts.left')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            You can update your settings below.
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nationality</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Malawi">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First name</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="First name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Middle name</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Middle name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Family name</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Family name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date of birth</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Date of birth">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Certificate type</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Certificate type">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID Number</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="ID Number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID Expiry date</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="ID Expiry date">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Residential address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Residential address">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
</div>

@include('layouts.footer')
