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
                  <i style="color:#dd4b39;" class="fa fa-warning"></i> It is detected that you have not bound the ERC20 address, please bind immediatedly!</h3>
                <h3 style="padding: 0 10px 30px 10px;" class="box-title">This address is the payment address. It cannot be modified after the binding is completed.Please be sure
                  to fill in the correct one.</h3>
              </div>

              <form role="form" action="/dobuy" method="post">
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
                    <label for="exampleInputEmail1">ERC20 address</label>
                    <input type="text" class="form-control" name="walletAddress" value="{{$walletAddress}}" placeholder="ERC20 address">
                  </div>

                  <div class="form-group">
                    <label>Coin type</label>
                    <select class="form-control select2" style="width: 100%;">
                      <option selected="selected">USDD</option>
                    </select>
                  </div>


                  <div class="form-group">
                    <label for="exampleInputPassword1">Coinage amount</label>
                    <input type="text" class="form-control" id="" name="amount" placeholder="Coinage amount">
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
  <script src="../../public/bower_components/select2/dist/js/select2.full.min.js"></script>

  <script>
    $(function () {
      //Initialize Select2 Elements
      $('.select2').select2()
    })
  </script>
@include('layouts.footer')