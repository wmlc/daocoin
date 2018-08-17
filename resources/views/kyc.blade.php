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
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- form start -->
                    <form role="form" action="/kyc/save" method="post">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" id="optionsRadios_type1" value="Natural_person" checked>
                                        Natural_person
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" id="optionsRadios_type2" value="Legal_person">
                                        Legal_person
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">First name</label>
                                <input type="text" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="First name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Middle name</label>
                                <input type="text" name="middlename" class="form-control" id="exampleInputEmail1" placeholder="Middle name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Family name</label>
                                <input type="text" name="familyname" class="form-control" id="exampleInputEmail1" placeholder="Family name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Gender</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios_gender1" value="Male" checked>
                                        Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios_gender2" value="Female">
                                        Female
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date of birth</label>
                                <input type="text" name="birth" class="form-control" id="" placeholder="Date of birth">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email</label>
                                <input type="text" name="email" class="form-control" id="" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">primary-phone-number</label>
                                <input type="text"  name="phone" class="form-control" id="" placeholder="primary-phone-number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type_address</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type_address" id="" value="home" checked>
                                        Home
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type_address" id="" value="company">
                                        Company
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Country</label>
                                <input type="text" name="country" class="form-control" id="" placeholder="Country">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Region</label>
                                <input type="text" name="region" class="form-control" id="" placeholder="Region">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">City</label>
                                <input type="text" name="city" class="form-control" id="" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Street</label>
                                <input type="text" name="street" class="form-control" id="" placeholder="Street">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Postal Code</label>
                                <input type="text" name="postalcode"  class="form-control" id="" placeholder="Postal Code">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Certificate type</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="certificate_type" id="" value="Valid Identity Card" checked>
                                        Valid Identity Card
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="certificate_type" id="" value="Passport">
                                        Passport
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID Number</label>
                                <input type="text" name="id_number" class="form-control" id="exampleInputEmail1" placeholder="ID Number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID Expiry date</label>
                                <input type="text" name="id_expire_date" class="form-control" id="exampleInputEmail1" placeholder="ID Expiry date">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Residential address</label>
                                <input type="text" name="residential_address" class="form-control" id="exampleInputEmail1" placeholder="Residential address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Certificate</label>
                                <input type="file" id="exampleInputFile">

                                <p class="help-block">Please upload a high resolution picture of the front of passport
                                                      The file can be in PDF, JPEG(.jpg) and PNG(.png) format and cannot exceed 2M
                                </p>

                                <input type="file" id="exampleInputFile">

                                <p class="help-block">Please upload a high resolution picture of the front of passport
                                                      The file can be in PDF, JPEG(.jpg) and PNG(.png) format and cannot exceed 2M
                                </p>

                                <input type="file" id="exampleInputFile">

                                <p class="help-block">Please upload a high resolution picture of the front of passport
                                                      The file can be in PDF, JPEG(.jpg) and PNG(.png) format and cannot exceed 2M
                                </p>
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
