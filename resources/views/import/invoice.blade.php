<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 100%;
            height: 100%;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            
            font-size: 12px;
            
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2.4em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
            background: url(dimension.png);
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 20px;
            text-align: right;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

    </style>
</head>

<body>
    <header class="clearfix">

        <h1>{{$data['import']->importorderid}}</h1>
        <div id="company" class="clearfix">
          <div>TechLink</div>
          <div>132 Ha Huy Giap<br /> Ha Huy Giap</div>
          <div>(602) 519-0450</div>
          <div><a href="mailto:company@example.com">techlink@gmail.com</a></div>
        </div>
        <div id="project">
        <div><span>SUPPLIER Name</span>{{$data['supplier']->suppliername}}</div>
          <div><span>ADDRESS</span> {{$data['supplier']->supplieraddress}}</div>
          <div><span>EMAIL</span> <a href="mailto:john@example.com">{{$data['supplier']->supplieremail}}</a></div>
          <div><span>ADDRESS</span> {{$data['supplier']->supplierphone}}</div>
          <div><span>DATE</span> {{$data['detailimport']->detailimportcreateddate}}</div>
        </div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th class="service">SERVICE</th>
                    <th class="desc">DESCRIPTION</th>
                    <th>PRICE</th>
                    <th>QTY</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <td class="service">Import</td>
              <td class="desc">{{$data['product']->productname}}</td>
                <td class="unit">{{$data['product']->productprice}}</td>
              <td class="qty">{{$data['detailimport']->detailimportquantity}}</td>
                <td class="total">{{$data['detailimport']->detailimportamount}}</td>
              </tr>
              <tr>
                <td colspan="4">SUBTOTAL</td>
                <td class="total">{{$data['detailimport']->detailimportamount}}</td>
              </tr>
              <tr>
                <td colspan="4">TAX</td>
              <td class="total">{{$tax = 0.05 * $data['detailimport']->detailimportamount}}</td>
              </tr>
              <tr>
                <td colspan="4" class="grand total">GRAND TOTAL</td>
                <td class="grand total">{{$data['detailimport']->detailimportamount + $tax}}</td>
              </tr>
            </tbody>
        </table>
        <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div>
    </main>
    <footer>
        Invoice was created on a computer and is valid without the signature and seal.
    </footer>
</body>

</html>
