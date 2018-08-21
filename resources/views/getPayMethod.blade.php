@include('layouts.header')
@include('layouts.left')
  <div class="wrapper">



    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          redeem coin
        </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">

          <div class="col-md-12">

            <div class="box box-primary">
              <div class="box-content" style="padding: 20px;">
                <h4>Your <strong>application redeem coin</strong> has been submitted successfully. </h4>
                <h3>Please Send Your Funds Now</h3>

                <p>The information below will be necessary to transfer the redemption amount to the ERC20 address. To proceed:</p>
                <p>Please transfer <strong>1000USDD</strong> of the <strong>"0xc8D6614c17566a09b1b4D378Fb5f7ca2D1b76519"</strong> erc20 address to the DaoCoin account.</p>
                <div class="row">
                  <div class="col-md-7 text-center">
                    <img style="width:200px; margin:20px 0;" src="../../public/assets/img/erweima.jpg" alt="">
                    <p><strong>0xc8D6614c17566a09b1b4D378Fb5f7ca2D1b76519</strong></p>
                    <a style="font-size: 26px;" href="javascript:void(0);">copy payment address</a>
                  </div>
                </div>

              </div>

              <form role="form">
                <div class="box-body" style="padding:20px;">
                  <div class="form-group">
                    <label for="">Transaction ID</label>
                    <input type="text" class="form-control" id="" placeholder="Transaction ID">
                  </div>

                  <p>The transaction ID is the transaction signature, indicating that the transfer is successful, please be sure to fill out.</p>

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