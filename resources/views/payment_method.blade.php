@include('layouts.header')
@include('layouts.left')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          convert coin
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-md-12">

            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 style="padding: 20px 10px;" class="box-title">
                  Your applacation coin has been submitted successfully.
                </h3>
              </div>

              <div class="box-content" style="padding:0 20px;">
                <h3>Please Send Your Funds Now</h3>
                <div>
                  <p>Currently, the platform only supports the offline <strong>wire transfer</strong> method.</p>
                  <p>The information below will be necessary for a wire transfer into Gemini. To proceed:</p>
                  <p>1. Contact your bank and initiate a same-day wire transfer of <strong>$1,000.00</strong> from your  account to "Gemini Trust Company LLC". If you initiate anything other than a same-day wire transfer, it will be rejected on our end.</p>     
                  <p>2. You <strong>MUST</strong> write <strong>{{$mem_code}}</strong> in the "memo" or "instructions" field of the wire transfer in order for funds to reach  Gemini account.</p>
                  <div class="row">
                      <div class="col-md-4 col-sm-6 col-xs-6 text-right">
                          <p><strong>ABA routing number:</strong></p>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                          <p>322286803</p>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-6 text-right">
                          <p><strong>Account number:</strong></p>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                          <p>1000808012</p>
                      </div>
                      <div class="col-md-4 col-sm-6 col-xs-6 text-right">
                          <p><strong>Memo/reference:</strong></p>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                          <p>VAYBJM</p>
                      </div>
                          
                      <div class="col-md-4 col-sm-6 col-xs-6 text-right">   
                          <p><strong>Receiving bank:</strong></p>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                          <p>Silvergate Bank</p>
                          <p>4275 Executive Square, Suite 300</p>
                          <p>La Jolla, CA 92037</p>
                          <p>United States Of America</p>
                      </div>

                      <div class="col-md-4 col-sm-6 col-xs-6 text-right">   
                          <p><strong>Destination account information:</strong></p>
                      </div>
                      <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                          <!-- Destination account information: -->
                          
                          <p>Gemini Trust Company LLC</p>
                          <p>600 Third Avenue, 2nd Fl</p>
                          <p>New York, NY 10016</p>
                          <p>United States Of America</p>
                      </div>
                  </div>
                  
                  
                  <div>
                    <p><strong>IMPORTANT: </strong>You <strong>MUST</strong> write <strong>{{$mem_code}}</strong> in the "memo" or "instructions" field of the wire transfer in order for funds to reach your Gemini account.</p>
                    <p>This information has also been sent to 675351292@qq.com</p>      
                  </div> 
                  <div style="color:#dd4b39; padding:30px 0;">
                    <p><i style="color:#dd4b39;" class="fa fa-warning"></i> Wire deposits must originate from the selected bank account above. Gemini will refuse funds originating from an unapproved bank account.</p>
                    <p>Please make a payment within 48 hours, otherwise it will be considered invalid.</p>
                  </div>
                    
            
                </div>
              </div>


              <div class="box-footer" style="padding:20px 20px 30px;">
                  <a href="/confirmbuy"><button style="padding:10px 40px;" type="submit" class="btn btn-primary">Submit</button></a>
              </div>
              
            </div>


          </div>

          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>


  </div>
  <script src="../../public/bower_components/select2/dist/js/select2.full.min.js"></script>

  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })
  </script>
@include('layouts.footer')