
<div class="col-xl-12 col-md-12 mb-4  text-center  bg-abasas-dark p-2 ">
    <div class="card border-none bg-abasas-dark p-2">
        <h3 class="text-white">ক্রেতা</h3>

        <div class="card-body">
            <div class="row no-gutters ">


                <form method="GET" id="orderPageCustomerForm">
                    @csrf
                    <div class="form-row ">
                        <div class="col-auto">
                            <form method="post">



                                <div class=" col-auto">
                                    <label class="text-light" for="orderPageCustomerPhoneField">ক্রেতার নাম্বার</label>
                                    <input type="text" name="phone" id="orderPageCustomerPhoneField" class="form-control mb-2">
                                </div>
                                <input type=" number" name="efsd" hidden>
                            </form>
                    </div>
                    </div>
                </form>
            </div>
            <div class=" text-samall text-danger" id="orderPageAddCustomerError">
            </div>
           <div id="orderPageCustomerView">
              <div id="orderPageCustomerName" class="text-light font-weight-bold"></div>
                <div id="orderPageCustomerPhone" class="text-light "></div>
                <div id="orderPageCustomerCompany" class="text-light "></div>
                <!-- <div id="orderPageCustomerDue" class="text-danger font-weight-bold"></div> -->
            </div>
            <form method="POST" action=" " id="orderPageAddCustomerForm">
                @csrf
                <div class="form-row a">
                    <div class="col-auto">
                        <input type="text" id="orderPageAddCustomerFormName" name="name" placeholder="name" class="form-control mb-2">
                    </div>
                    <div class="col-auto">
                        <input type="text" id="orderPageAddCustomerFormPhone" name="phone" class="form-control mb-2" hidden>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="orderPageAddCustomerFormAddress" name="address" placeholder="address" class="form-control mb-2">
                    </div>
                    <div class="col-auto">
                        <input type="text" id="orderPageAddCustomerFormCompany" name="company" placeholder="company" class="form-control mb-2">
                    </div>
                    <div class="col-auto">
                        <button type="button" id="orderPageAddCustomerButton" class="btn btn-primary mt-3">সম্পন্ন</button>
                    </div>
            </form>
        </div>
    </div>
</div>
