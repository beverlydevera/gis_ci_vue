<style>
body { 
    margin: 15px; 
    padding-top: 40px;
    /* margin: 35px 45px 35px 45px;  */
    font-family: Arial, Helvetica, sans-serif;
    text-align: justify;

    /* background-image: url("<?=FCPATH?>assets/img/bravehearts_logo.jpg");
    background-repeat: no-repeat;
    background-size: cover;
    opacity: 0.5; */
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
    bottom: 8px; 
    left: 10px; 
    right: 10px;

    height: 50px;
    text-align: center !important;
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

<body style="width: 100%;">
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
    <table cellpadding="2">
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
            <td rowspan=3 style="text-align:right; color:#800000; font-size:35px;">P0.00</td>
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

    <hr style="border-top: 3px double #800000">

    <div style="border:1px solid black;">
        <h3>Billing Breakdown</h3>
        <table cellpadding="5">
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
                <td colspan=4></td>
            </tr>
            <tr>
                <td colspan=4><hr style="border-top: 1px dotted #800000"></td>
            </tr>
            <tr>
                <td rowspan=2></td>
                <td rowspan=2></td>
                <th>Amount Due (PHP)</th>
                <td style="text-align:right;">P 4,800.00</td>
            </tr>
        </table>
    </div>

    <!-- <footer>
        Bravehearts Martial Arts Institute <br>
        Telephone (6374) 444 8129 | 444 3638 | 444 3262 • Telefax (6374) 442 7917 | 304 3949 <br>
        E-mail:  braveheartsinstitute@gmail.com <br>
        Website: <span style="color:blue;">www.braveheartsinstitute.com</span>
    </footer> -->
    </div>
</body>