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

        .img-fluid {
            max-width: 100%;
            height: auto
        }

        .rounded {
            border-radius: .25rem !important
        }

        .mx-auto {
            margin-right: auto !important;
            margin-left: auto !important
        }

        .d-block {
            display: block !important
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem
        }

        .mt-3 {
            margin-top: 1rem !important
        }

        .text-center {
            text-align: center !important;
        }

        .card-body {
            flex: 1 1 auto;
            padding: 1rem 1rem
        }

        .bg-light {
            background-color: #f8f9fa !important
        }

        .border {
            border: 1px solid #dee2e6 !important
        }

        .border-warning {
            border-color: #ffc107 !important
        }

        .p-2 {
            padding: .5rem !important
        }

        .text-success {
            color: #198754 !important
        }
        .container{
            --bs-gutter-x: 1.5rem;
            --bs-gutter-y: 0;
            width: 100%;
            padding-right: calc(var(--bs-gutter-x) * 0.5);
            padding-left: calc(var(--bs-gutter-x) * 0.5);
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
             .container {
                max-width: 540px;
            }
        }
        @media (min-width: 768px) {
             .container {
                max-width: 720px;
            }
        }
        @media (min-width: 992px) {
             .container {
                max-width: 960px;
            }
        }
        @media (min-width: 1200px) {
             .container {
                max-width: 1140px;
            }
        }
        @media (min-width: 1400px) {
             .container {
                max-width: 1320px;
            }
        }
    </style>
</head>

<body class="bg-light">
<div class="container">
    <img class="img-fluid rounded mx-auto d-block" id="image-preview"
         src="https://img.freepik.com/free-vector/enter-otp-concept-illustration_114360-7887.jpg?w=740&t=st=1681986081~exp=1681986681~hmac=e81314ada432d018bb2057c56e11f57c1039998425c2251ced28f49cbc88662e"
         alt="pic">
    <div class="card mx-auto text-center mt-3" style="width: 25rem;">
        <div class="card-body mx-auto">
            <p>Hello,</p>
            <p>Please use this following code below:</p>
            <p class="border border-warning p-2" id="button">{{$details['code']}}</p>
            <p class="text-success" id="message"></p>
            <p class="text-success">Thank You</p>
        </div>
    </div>
</div>
<script>
    const copyText = document.getElementById('button');

    copyText.addEventListener('click', () => {
        const text = copyText.innerText;

        navigator.clipboard.writeText(text)
            .then(() => {
                document.getElementById('message').innerText = "! Code copy on your clipboard";
                setTimeout(() => {
                    message.innerText = '';
                }, 1000);
            })
            .catch((error) => {
                console.error('Could not copy text: ', error);
            });
    });
</script>
</body>
