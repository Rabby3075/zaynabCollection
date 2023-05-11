
<head>
    <style>
        #image-preview {
            height: 300px;
            width: 400px;
        }
        #button:hover {
            background-color: rgb(251, 201, 2) !important;
            transition: background-color 0.5s ease-out;
            color: white !important;
        }
        .img-fluid{
            max-width:100%;
            height:auto
        }
        .rounded{
            border-radius:.25rem!important
        }
        .mx-auto{
            margin-right:auto!important;
            margin-left:auto!important
        }
        .d-block{
            display:block!important
        }
        .card{
            position:relative;
            display:flex;
            flex-direction:column;
            min-width:0;
            word-wrap:break-word;
            background-color:#fff;
            background-clip:border-box;
            border:1px solid rgba(0,0,0,.125);
            border-radius:.25rem
        }
        .mt-3{
            margin-top:1rem!important
        }
        .text-center{
            text-align:center!important
        }
        .card-body{
            flex:1 1 auto;
            padding:1rem 1rem
        }
        .bg-light{
            background-color:#f8f9fa!important
        }
        .border{
            border:1px solid #dee2e6!important
        }
        .border-warning{
            border-color:#ffc107!important
        }
        .p-2{
            padding:.5rem!important
        }
        .text-success{
            color:#198754!important
        }
    </style>
</head>
<body class="bg-light">
<img class="img-fluid rounded mx-auto d-block" id="image-preview" src="https://img.freepik.com/free-vector/enter-otp-concept-illustration_114360-7887.jpg?w=740&t=st=1681986081~exp=1681986681~hmac=e81314ada432d018bb2057c56e11f57c1039998425c2251ced28f49cbc88662e" alt="pic">
<div class="card mx-auto mt-3" style="width: 25rem;">
    <div class="card-body mx-auto">
        <p class="mx-auto">Hello, Admin</p>
        <p class="mx-auto">Please use this following code below:</p>
        <p class="border border-warning p-2 mx-auto" id="button">{{$details['code']}}</p>
        <p class="text-success mx-auto">Thank You</p>
    </div>
</div>
</body>
