@include('layouts.header')
@include('layouts.left')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Individual
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
                            <div class="form-group">
                                <label for="exampleInputFile">Certificate</label>
                                <input type="file" id="exampleInputFile">

                                <p class="help-block">Please upload a high resolution picture of the front of passport
                                                      The file can be in PDF, JPEG(.jpg) and PNG(.png) format and cannot exceed 2M
                                </p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Proof of address</label>
                                <input type="file" id="exampleInputFile">

                                <p class="help-block">Please upload a high resolution picture of the front of passport
                                                      The file can be in PDF, JPEG(.jpg) and PNG(.png) format and cannot exceed 2M
                                </p>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <h3>Acceptable proof of address documents are listed below:</h3>
                                </label>
                                <br>
                                <label>
                                    1. Government issued document<br>
                                    2. Council rates<br>
                                    3. Utility bill (e.g electricity, water, gas, internet, tv)<br>
                                    4. Landline bill (mobile phones are not landlines)<br>
                                    5. Vehicle registration/insurance<br>
                                    6. Financial institution statement (e.g bank account, loan, credit card)<br>
                                    7. Property insurance letter<br>
                                </label>


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
