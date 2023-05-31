@extends('Admin.Dashboard.Main.main')
@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold">Welcome Admin</h3>
                    @if(Session::has('message'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <p>{{Session::get('message')}}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card tale-bg">
                <div class="card-people mt-auto">
                    <img src="images/dashboard/people.svg" alt="people">
                    <div class="weather-info">
                        <div class="d-flex">
                            <div>
                                <h2 class="mb-0 font-weight-normal" id="temp"></h2>
                            </div>
                            <div class="ml-2">
                                <h4 class="location font-weight-normal" id="city"></h4>
                                <h6 class="font-weight-normal" id="country"></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin transparent">
            <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-tale">
                        <div class="card-body">
                            <p class="mb-4">Today’s Orders</p>
                            <p class="fs-30 mb-2">4006</p>
                            <p>10.00% (30 days)</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                    <div class="card card-dark-blue">
                        <div class="card-body">
                            <p class="mb-4">Total Orders</p>
                            <p class="fs-30 mb-2">61344</p>
                            <p>22.00% (30 days)</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                    <div class="card card-light-blue">
                        <div class="card-body" id="productBody">
                            <p class="mb-4">Number of Products</p>
                            <p class="fs-30 mb-2">{{$product->count()}}</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 stretch-card transparent">
                    <div class="card card-light-danger">
                        <div class="card-body">
                            <p class="mb-4">Registered Customers</p>
                            <p class="fs-30 mb-2">{{$users->count()}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if($productCategory->count()>0)
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Product Category
                        <button class="btn btn-sm btn-primary" onclick="downloadChart()">Download Chart</button>
                    </h5>
                    <div class="card-body">
                        <canvas id="productCategory"></canvas>
                    </div>
                </div>
            </div>
        @endif
        @if($product->count()>0)
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <h5 class="card-header d-flex justify-content-between align-items-center">
                        Product
                        <button class="btn btn-sm btn-primary" onclick="downloadChart()">Download Chart</button>
                    </h5>
                    <div class="card-body">
                        <canvas id="product"></canvas>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script>
        document.getElementById('city').innerText = geoplugin_city()
        console.log(geoplugin_city())
        document.getElementById('country').innerText = geoplugin_countryName()
        console.log(geoplugin_countryName())

        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var resp = JSON.parse(this.responseText);
                console.log(resp);
                let temp = resp.main.temp;
                console.log(temp)
                let celcius = temp - 273.15;
                console.log(celcius)
                document.getElementById('temp').innerHTML = "<i class='icon-sun mr-2'></i>" + celcius.toFixed(2) + "<sup>C</sup>"
            }
        };
        xhttp.open("GET", `https://api.openweathermap.org/data/2.5/weather?lat=${geoplugin_latitude()}&lon=${geoplugin_longitude()}&appid=25901c16a28a5636d424f2c7142e1d47`);
        xhttp.send();
    </script>
    <script>
        var ctx = document.getElementById('productCategory').getContext('2d');
        var data = @json($productCategory);
        var names = [];
        var quantities = [];
        data.forEach(function (item) {
            names.push(item.categoryName);
            quantities.push(item.count);
        });
        var productCategory = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: names,
                datasets: [{
                    label: 'Product',
                    data: quantities,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        function downloadChart() {
            var url_base64 = document.getElementById("productCategory").toDataURL("image/png");
            var a = document.createElement("a");
            a.href = url_base64;
            a.download = "category.png";
            document.body.appendChild(a);
            a.click();
        }
    </script>
    <script>
        var ctx = document.getElementById('product').getContext('2d');
        var data = @json($product);
        var names = [];
        var quantities = [];
        data.forEach(function (item) {
            names.push(item.productName);
            quantities.push(item.quantity);
        });
        var productCategory = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: names,
                datasets: [{
                    label: 'Quantity',
                    data: quantities,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        function downloadChart() {
            var url_base64 = document.getElementById("product").toDataURL("image/png");
            var a = document.createElement("a");
            a.href = url_base64;
            a.download = "product.png";
            document.body.appendChild(a);
            a.click();
        }
    </script>
@endsection

