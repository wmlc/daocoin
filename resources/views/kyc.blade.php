@include('layouts.header')
@include('layouts.left')

<!-- bootstrap datepicker -->
  <link rel="stylesheet" href="../../public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../public/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">

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
                    <form role="form" action="/kyc/save" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type" id="optionsRadios_type1" value="natural_person" checked>
                                        Natural_person
                                    </label>
                                    &nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="type" id="optionsRadios_type2" value="Legal_person">
                                        Legal_person
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">First name</label>
                                <input type="text" name="firstname" class="form-control" id="" placeholder="First name">
                            </div>
                            <div class="form-group">
                                <label for="">Middle name</label>
                                <input type="text" name="middlename" class="form-control" id="" placeholder="Middle name">
                            </div>
                            <div class="form-group">
                                <label for="">Family name</label>
                                <input type="text" name="familyname" class="form-control" id="" placeholder="Family name">
                            </div>
                            <div class="form-group">
                                <label for="">Gender</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios_gender1" value="Male" checked>
                                        Male
                                    </label>
                                    &nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios_gender2" value="Female">
                                        Female
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Date of birth</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="birth" class="form-control pull-right" id="datepicker" placeholder="Date of birth">
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" id="" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="">Primary-phone-number</label>
                                <input type="text"  name="phone" class="form-control" id="" placeholder="Primary-phone-number">
                            </div>
                            <div class="form-group">
                                <label for="">Type_address</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type_address" id="" value="home" checked>
                                        Home
                                    </label>
                                    &nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="type_address" id="" value="company">
                                        Company
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" name="country" class="form-control" id="" placeholder="Country">
                            </div>
                            <div class="form-group">
                                <label for="">Region</label>
                                <input type="text" name="region" class="form-control" id="" placeholder="Region">
                            </div>
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" name="city" class="form-control" id="" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="">Street</label>
                                <input type="text" name="street" class="form-control" id="" placeholder="Street">
                            </div>
                            <div class="form-group">
                                <label for="">Postal Code</label>
                                <input type="text" name="postalcode"  class="form-control" id="" placeholder="Postal Code">
                            </div>
                            <div class="form-group">
                                <label for="">Certificate type</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="certificate_type" id="" value="Valid Identity Card" checked>
                                        Valid Identity Card
                                    </label>
                                    &nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="certificate_type" id="" value="Passport">
                                        Passport
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">ID Number</label>
                                <input type="text" name="id_number" class="form-control" id="" placeholder="ID Number">
                            </div>


                            <div class="form-group">
                                <label>ID Expiry date</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" name="id_expire_date" class="form-control pull-right" id="datepicker1" placeholder="ID Expiry date">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="">Residential address</label>
                                <input type="text" name="residential_address" class="form-control" id="" placeholder="Residential address">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Certificate</label>
                                <input type="file" name="id_img">

                                <p class="help-block">Please upload a high resolution picture of the front of passport
                                                      The file can be in PDF, JPEG(.jpg) and PNG(.png) format and cannot exceed 2M
                                </p>

                                <input type="file" name="id_back_img">

                                <p class="help-block">Please upload a high resolution picture of the front of passport
                                                      The file can be in PDF, JPEG(.jpg) and PNG(.png) format and cannot exceed 2M
                                </p>
n
                                <input type="file" name="id_person_img">

                                <p class="help-block">Please upload a high resolution picture of the front of passport
                                                      The file can be in PDF, JPEG(.jpg) and PNG(.png) format and cannot exceed 2M
                                </p>
                            </div>

                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button style="padding:10px 40px;" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
</div>


<!-- bootstrap datepicker -->
<script src="../../public/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap color picker -->
<script src="../../public/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../../public/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    $('#datepicker1').datepicker({
      autoclose: true
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

</script>

@include('layouts.footer')
