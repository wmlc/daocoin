@include('layouts.header')
@include('layouts.left')

<!-- bootstrap datepicker -->
  <link rel="stylesheet" href="/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
<!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">

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
                                        @if(isset($kycInfo['type']) && $kycInfo['type'] == 'natural_person')
                                            <input type="radio" name="type" id="optionsRadios_type1" value="natural_person" checked>
                                        @else
                                            <input type="radio" name="type" id="optionsRadios_type1" value="natural_person">
                                        @endif
                                        Natural_person
                                    </label>
                                    &nbsp;&nbsp;
                                    <label>
                                        @if(isset($kycInfo['type']) && $kycInfo['type'] == 'legal_person')
                                            <input type="radio" name="type" id="optionsRadios_type2" value="legal_person" checked>
                                        @else
                                            <input type="radio" name="type" id="optionsRadios_type2" value="legal_person">
                                        @endif

                                        Legal_person
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">First name</label>
                                @if(isset($kycInfo['first_name']))
                                    <input type="text" name="firstname" class="form-control" value="{{$kycInfo['first_name']}}" id="" placeholder="First name">
                                @else
                                    <input type="text" name="firstname" class="form-control" id="" placeholder="First name">
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="">Middle name</label>
                                @if(isset($kycInfo['middle_name']))
                                    <input type="text" name="middlename" value="{{$kycInfo['middle_name']}}" class="form-control" id="" placeholder="Middle name">
                                @else
                                    <input type="text" name="middlename" class="form-control" id="" placeholder="Middle name">
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="">Family name</label>
                                <input type="text" name="familyname"  value="{{isset($kycInfo['family_name']) ? $kycInfo['family_name'] : ''}}" class="form-control" id="" placeholder="Family name">
                            </div>
                            <div class="form-group">
                                <label for="">Gender</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios_gender1" value="Male" {{isset($kycInfo['gender']) && $kycInfo['gender'] == 'Male' ? 'checked' : ''}}>
                                        Male
                                    </label>
                                    &nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="gender" id="optionsRadios_gender2" value="Female" {{isset($kycInfo['gender']) && $kycInfo['gender'] == 'Female' ? 'checked' : ''}}>
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
                                    <input type="text" value="{{isset($kycInfo['birth']) ? $kycInfo['birth'] : ''}}" name="birth" class="form-control pull-right" id="datepicker" placeholder="Date of birth">
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email"  value="{{isset($kycInfo['email']) ? $kycInfo['email'] : ''}}" class="form-control" id="" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="">Primary-phone-number</label>
                                <input type="text" value="{{isset($kycInfo['phone']) ? $kycInfo['phone'] : ''}}"  name="phone" class="form-control" id="" placeholder="Primary-phone-number">
                            </div>
                            <div class="form-group">
                                <label for="">Type_address</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="type_address" id="" value="home" {{isset($kycInfo['type_address']) && $kycInfo['type_address'] == 'home' ? 'checked' : ''}}>
                                        Home
                                    </label>
                                    &nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="type_address" id="" value="company" {{isset($kycInfo['type_address']) && $kycInfo['type_address'] == 'company' ? 'checked' : ''}}>
                                        Company
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Country</label>
                                <input type="text" name="country" value="{{isset($kycInfo['country']) ? $kycInfo['country'] : ''}}" class="form-control" id="" placeholder="Country">
                            </div>
                            <div class="form-group">
                                <label for="">Region</label>
                                <input type="text" name="region" value="{{isset($kycInfo['region']) ? $kycInfo['region'] : ''}}" class="form-control" id="" placeholder="Region">
                            </div>
                            <div class="form-group">
                                <label for="">City</label>
                                <input type="text" name="city" value="{{isset($kycInfo['city']) ? $kycInfo['city'] : ''}}" class="form-control" id="" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="">Street</label>
                                <input type="text" name="street" value="{{isset($kycInfo['street']) ? $kycInfo['street'] : ''}}" class="form-control" id="" placeholder="Street">
                            </div>
                            <div class="form-group">
                                <label for="">Postal Code</label>
                                <input type="text" name="postalcode" value="{{isset($kycInfo['postalcode']) ? $kycInfo['postalcode'] : ''}}"  class="form-control" id="" placeholder="Postal Code">
                            </div>
                            <div class="form-group">
                                <label for="">Certificate type</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" {{isset($kycInfo['certificate_type']) && $kycInfo['certificate_type'] == 'Valid Identity Card' ? 'checked' : ''}} name="certificate_type" id="" value="Valid Identity Card">
                                        Valid Identity Card
                                    </label>
                                    &nbsp;&nbsp;
                                    <label>
                                        <input type="radio" name="certificate_type" id="" value="Passport" {{isset($kycInfo['certificate_type']) && $kycInfo['certificate_type'] == 'Passport' ? 'checked' : ''}}>
                                        Passport
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">ID Number</label>
                                <input type="text" value="{{isset($kycInfo['certificate_id']) ? $kycInfo['certificate_id'] : ''}}" name="id_number" class="form-control" id="" placeholder="ID Number">
                            </div>


                            <div class="form-group">
                                <label>ID Expiry date</label>

                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" value="{{isset($kycInfo['certificate_expiry_date']) ? $kycInfo['certificate_expiry_date'] : ''}}" name="id_expire_date" class="form-control pull-right" id="datepicker1" placeholder="ID Expiry date">
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="">Residential address</label>
                                <input type="text" value="{{isset($kycInfo['address']) ? $kycInfo['address'] : ''}}" name="residential_address" class="form-control" id="" placeholder="Residential address">
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
@include('layouts.footer')

<!-- bootstrap datepicker -->
<script src="/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js"></script>
<!-- bootstrap time picker -->
<script src="/plugins/timepicker/bootstrap-timepicker.min.js"></script>
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


