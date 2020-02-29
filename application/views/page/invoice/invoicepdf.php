<style>
body { 
    width: 100%;
    margin: 15px; 
    /* margin: 35px 45px 35px 45px;  */
    font-family: Arial, Helvetica, sans-serif;
    text-align: justify;

    background-image: url("<?=FCPATH?>assets/img/braveheartspng.png");
    background-repeat: no-repeat;
    background-size: cover;
    /* opacity: 0.5; */
}
#frontpage {
    padding-top: 30px;
}
#backpage {
    padding-top: 0px;
}
.font-bold {
    font-weight: bold; 
}
.font-normal {
    font-weight: normal;
}
.font-italic {
    font-style: italic !important;
}
footer {
    position: fixed; 
    bottom: 6px; 
    left: 10px; 
    right: 10px;

    height: 40px;
    text-align: left !important;
    font-size: 12px; /* font: 8 */
    font-family: "Times New Roman", Times, serif !important;
}
.brandname {
    margin: -170px 0 -20px 160px;
    color: #800000;
}
h3 {
    text-align:center;
}
table {
    width: 100%;
}
th {
    color: #800000;
}
</style>

<body id="frontpage">
    <div id="child">
    <header>
        <img src="<?=FCPATH?>assets/img/bravehearts_logo.jpg" style="height:140px;">
        <div class="brandname">
            <h2 class="braveheartsname">BRAVEHEARTS MARTIAL ARTS INSTITUTE</h2>
            <p class="address">
                Branch Name <br>
                Address, Zip Code <br>
                0912-345-6789 / www.braveheartsinstitute.com
            </p>
        </div>
    </header>
    <br>
    
    <hr style="border-top: 5px solid #800000">

    <h3>Statement of Account</h3>
    <table cellpadding="1">
        <tr>
            <th style="width:30%;">Billed to</th>
            <th style="width:20%;">Date of Issue</th>
            <th style="width:20%;">Invoice Number</th>
            <th style="width:30%; text-align:right;">Amount Due (PHP)</th>
        </tr>
        <tr>
            <td rowspan=2>
                <u> ABC </u> <br>
                ID No. <u> 123 </u>
            </td>
            <td>01/01/2020</td>
            <td>INV-00001</td>
            <th rowspan=3 style="text-align:right; color:#800000; font-size:30px;">P1,800.00</th>
        </tr>
        <tr>
            <td colspan=2></td>
        </tr>
        <tr>
            <td rowspan=2></td>
            <th>Due Date</th>
            <th>Reference</th>
        </tr>
        <tr>
            <td>02/19/2020</td>
            <td>Enter Value</td>
        </tr>
    </table>
    <br>

    <hr style="border-top: 3px solid #800000">

    <div>
        <h3>Invoice Breakdown</h3>
        <table cellpadding="3">
            <tr>
                <th style="text-align:center;">Item / Description</th>
                <th style="text-align:center;">Rate</th>
                <th style="text-align:center;">Qty</th>
                <th style="text-align:center;">Total</th>
            </tr>
            <tr>
                <td>Package 1</td>
                <td style="text-align:center;">P 1,500.00</td>
                <td style="text-align:center;">2</td>
                <td style="text-align:right;">P 3,000.00</td>
            </tr>
            <tr>
                <td>Package 2</td>
                <td style="text-align:center;">P 1,800.00</td>
                <td style="text-align:center;">1</td>
                <td style="text-align:right;">P 1,800.00</td>
            </tr>
            <tr>
                <td colspan=4><hr style="border-top: 1px dotted #800000"></td>
            </tr>
            <tr>
                <td rowspan=2></td>
                <th colspan=2 style="text-align:right;">Total Invoice Amount (PHP)</th>
                <td style="text-align:right;">P 4,800.00</td>
            </tr>
        </table>
    </div>

    <hr style="border-top: 2px solid #800000">

    <div style="width:45%; float:right;">
        <table>
            <tr>
                <th>Total Invoice Amount</th>
                <td style="text-align:right;">P 4,800.00</td>
            </tr>
            <tr>
                <th>Total Amount Paid</th>
                <td style="text-align:right;">- P 3,000.00</td>
            </tr>
            <tr>
                <td colspan=2 style="font-size:10px;">(See payment history at the back)</td>
            </tr>
            <tr>
                <td colspan=2><hr style="border-top: 1px dotted #000"></td>
            </tr>
            <tr>
                <th>Remaining Balance</th>
                <td style="text-align:right;">P 1,800.00</td>
            </tr>
        </table>
    </div>

    </div>
    <footer>
        Bravehearts Martial Arts Institute <br>
        Statement of Account for: <span style="color:blue;">Student ABC</span><br>
        <?=date("F d, Y")?>
    </footer>
</body>

<body id="backpage">
    <div>
        <h3>Payments History</h3>
        <table style="text-align:center;">
            <tr>
                <th>Date</th>
                <th>OR Number</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>01/01/2020</td>
                <td>2020-00001</td>
                <td>P 1,000.00</td>
            </tr>
            <tr>
                <td>01/01/2020</td>
                <td>2020-00002</td>
                <td>P 2,000.00</td>
            </tr>
            <tr>
                <td colspan=3><hr style="border-top: 1px dotted #800000"></td>
            </tr>
            <tr>
                <td rowspan=2></td>
                <th>Total Amount Paid (PHP)</th>
                <td>P 3,000.00</td>
            </tr>
        </table>
    </div>
</body>