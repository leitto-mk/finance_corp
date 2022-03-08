<style>
  .head-detail {
    margin-top: 20px;
  }

  .table.no-bordered th,
  .table.no-bordered td {
    border: none;
    padding: 0 10px;
  }

  th.pl-0 {
    padding-left: 0 !important;
  }

  hr {
    margin-top: 13px;
  }

  .pl-20 {
    padding-left: 20px !important;
  }
</style>
<div class="invoice-content-2 bordered">
  <div class="row invoice-head">
    <div class="row">
      <div class="col-md-7 col-xs-6">
        <div class="invoice-logo">
          <img src="<?= base_url('assets/abase.png') ?>" alt="" class="img-responsive" width="200px">
        </div>
      </div>
      <div class="col-md-5 col-xs-6">
        <h1 class="uppercase text-right">
          <span class="label bg-blue-chambray bg-font-blue-chambray" style="padding: 5px 120px;">
            <strong>Invoice</strong>
          </span>
        </h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="row">
          <div class="col-md-6 col-xs-4">
            <div class="head-detail">
              <span class="bold uppercase">PT. Andalan Banua Sejahtera</span>
              <br /> Jl. AA Maramis No. 7A, Ruko Lt.2
              <br /> Mapanget, Manado 95256
              <br />
            </div>
          </div>
          <div class="col-md-6 col-xs-6">
            <div class="head-detail">
              <table class="table no-bordered">
                <tbody>
                  <tr>
                    <th class="pl-0">Phone</th>
                    <td width="1%">:</td>
                    <td>0811-430-1129, 0811-495299</td>
                  </tr>
                  <tr>
                    <th class="pl-0">Email</th>
                    <td width="1%">:</td>
                    <td>Sesca_Salindeho@yahoo.com</td>
                  </tr>
                  <tr>
                    <th class="pl-0">Web</th>
                    <td width="1%">:</td>
                    <td>www.abasets.com</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 col-xs-4">
            <div class="head-detail">
              <span class="bold">Bill To</span>
              <hr>
              <span class="bold uppercase">Indonesian Publishing House</span>
              <br /> Jl. Raya Cimindi No. 72
              <br /> Bandung, Jawa Barat, 40184
              <br />
            </div>
          </div>
          <div class="col-md-6 col-xs-6">
            <div class="head-detail">
              <span class="bold">Ship To</span>
              <hr>
              <span class="bold uppercase">Indonesian Publishing House</span>
              <br /> Jl. Raya Cimindi No. 72
              <br /> Bandung, Jawa Barat, 40184
              <br />
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="row">
          <div class="col-md-12">
            <div class="head-detail">
              <table class="table no-bordered">
                <tbody>
                  <tr>
                    <th class="pl-0">Invoice No</th>
                    <td width="1%">:</td>
                    <td>ABASE/21-11/001</td>
                  </tr>
                  <tr>
                    <th class="pl-0">Reference Doc. No</th>
                    <td width="1%">:</td>
                    <td>QuoteNo</td>
                  </tr>
                  <tr>
                    <th class="pl-0">Account No.</th>
                    <td width="1%">:</td>
                    <td>See Payment</td>
                  </tr>
                  <tr>
                    <th class="pl-0">Date</th>
                    <td width="1%">:</td>
                    <td>November 1st, 2021</td>
                  </tr>
                  <tr>
                    <th class="pl-0">Due Date</th>
                    <td width="1%">:</td>
                    <td>November 20th, 2021</td>
                  </tr>
                  <tr>
                    <th class="pl-0">Terms</th>
                    <td width="1%">:</td>
                    <td>2% 10 Net 30</td>
                  </tr>
                  <tr>
                    <th class="pl-0">Contract No.</th>
                    <td width="1%">:</td>
                    <td>AB01-115</td>
                  </tr>
                  <tr>
                    <th class="pl-0">Sales Resp</th>
                    <td width="1%">:</td>
                    <td>Tere</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <table class="table table-bordered">
      <thead class="bg-blue-chambray bg-font-blue-chambray">
        <tr>
          <th class="text-center" width="5%">Item No</th>
          <th class="text-center">Stockcode</th>
          <th class="text-center">Stock Description</th>
          <th class="text-center">UOM</th>
          <th class="text-center">Quantity</th>
          <th class="text-center">Price</th>
          <th class="text-center">Discount(%)</th>
          <th class="text-center">Amount</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center">1</td>
          <td>162SS-421</td>
          <td>PA. SEKOLAH SABAT DEWASA 3/2021</td>
          <td class="text-center">EA</td>
          <td class="text-right">10</td>
          <td class="text-right">15000</td>
          <td class="text-right">10%</td>
          <td class="text-right">149,999.10</td>
        </tr>
        <tr>
          <td class="text-center">2</td>
          <td>162SS-421</td>
          <td>PA SEKOLAH SABAT DEWASA 3/2021</td>
          <td class="text-center">EA</td>
          <td class="text-right">20</td>
          <td class="text-right">10000</td>
          <td class="text-right">0%</td>
          <td class="text-right">199,999.00</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="row">
        <table class="table table-bordered">
          <thead class="bg-blue-chambray bg-font-blue-chambray">
            <tr>
              <th>Payment</th>
              <th>Approval</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td height="180px;" width="50%" class="bold pl-20">
                <p>Transfer to the following account:</p>
                <p>
                  PT ANDALAN BANUA SEJAHTERA
                  <br> BANK BANK, Acc. No. xxxxxxxx
                  <br> CABANG MANADO
                </p>
              </td>
              <td width="50%" class="pl-20">
                <p style="margin-bottom: 80px;">
                  <strong>Approved By</strong>
                </p>
                <div class="row">
                  <div class="col-md-6 col-sm-6">
                    <p>
                      <strong><u>Sesca Londah</u></strong>
                      <br>Finance & Admin Manager
                    </p>
                  </div>
                  <div class="col-md-6 col-sm-6">
                    <p class="text-center">
                      <strong>Approved Date</strong>
                    </p>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="col-md-4">
      <div class="row">
        <table class="table no-bordered">
          <tbody>
            <tr>
              <th class="text-right" style="padding-bottom: 20px;">Sub Total</th>
              <td width="1%">:</td>
              <td class="text-right">349,998.10</td>
            </tr>
            <tr>
              <th class="text-right">Tax</th>
              <td width="1%">:</td>
              <td class="text-right"></td>
            </tr>
            <tr>
              <th class="text-right" style="padding-bottom: 20px">Freight</th>
              <td width="1%">:</td>
              <td class="text-right"></td>
            </tr>
            <tr>
              <th class="text-right">Total Payment</th>
              <td width="1%">:</td>
              <td class="text-right">349,998.10</td>
            </tr>
            <tr>
              <td colspan="3" class="text-center" style="padding:20px">
                <p>(<?= terbilang(349998, 2) ?> )</p>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class=" row">
    <div class="portlet box grey-gallery">
      <div class="portlet-title">
        <div class="caption">
          Shipping Status
        </div>
      </div>
      <div class="portlet-body">
        <div class="row">
          <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label for="send-doc-no" class="control-label">Send Doc No</label>
              <input type="text" name="send_doc_no" id="send-doc-no" class="form-control">
            </div>
            <div class="form-group">
              <label for="receipt-by" class="control-label">Receipt By</label>
              <input type="text" name="receipt_by" id="receipt-by" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="form-group">
              <label for="send-date" class="control-label">Send Date</label>
              <input type="text" name="send_date" id="send-date" class="form-control">
            </div>
            <div class="form-group">
              <label for="received-date" class="control-label">Received Date</label>
              <input type="text" name="received_date" id="received-date" class="form-control">
            </div>
          </div>
          <div class="col-lg-4 col-md-4">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label for="send-by" class="control-label">Send By</label>
                  <input type="text" name="send_by" id="send-by" class="form-control">
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <div class="form-group">
                  <label for="send-via" class="control-label">Send Via</label>
                  <input type="text" name="send_via" id="send-via" class="form-control">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label for="notes" class="control-label">Notes</label>
                  <input type="text" name="notes" id="notes" class="form-control">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>