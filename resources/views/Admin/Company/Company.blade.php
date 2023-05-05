@if(Session::get('email'))
    @extends('Admin.Dashboard.Main.main')
    @section('content')
        <style>
            #image-preview {
                height: 150px; /* Set the fixed height */
                padding: 0; /* Remove padding */
            }
        </style>
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Company Information</h4>
                    @if (\Session::has('success'))
                        <div id="toast-container">
                            <div class="toast align-items-center text-white bg-success" role="alert"
                                 aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        <i class="bi bi-check-circle"></i>
                                        <label id="msg"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form-sample" action="{{route('companyManagement')}}" method="post"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Company Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="companyName"
                                               value="@if(!empty($company->companyName)){{$company->companyName}}@endif"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Business Type</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="businessType"
                                               value="@if(!empty($company->businessType)){{$company->businessType}}@endif"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Business moto</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="businessMoto"
                                               value="@if(!empty($company->businessMoto)){{$company->businessMoto}}@endif"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Facebook Page Link</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="url" name="fbLink"
                                               value="@if(!empty($company->fbLink)){{$company->fbLink}}@endif"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="email" name="email"
                                               value="@if(!empty($company->email)){{$company->email}}@endif"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Mobile Number</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" type="number" name="mobile"
                                               value="@if(!empty($company->mobile)){{$company->mobile}}@endif"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="address" rows="4">@if(!empty($company->address)){{$company->address}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Owner Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="ownerName"
                                               value="@if(!empty($company->ownerName)){{$company->ownerName}}@endif"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label">Logo</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="image" id="image" class="file-upload-default">
                                            <div class="input-group col-xs-12">
                                                <input type="text" class="form-control file-upload-info" disabled
                                                       placeholder="@if(!empty($company->logo)) {{$company->logo}} @else Upload Logo @endif">
                                                <span class="input-group-append">
                                                    <button class="file-upload-browse btn btn-primary" type="button">@if(!empty($company->logo)) Update Logo @else Add Logo @endif</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-2">
                                        <div class="col-sm-12">
                                            @if(!empty($company->logo))
                                            <img src="/Company/{{$company->logo}}" class="img-thumbnail mx-auto d-block" id="image-preview" alt="Company Logo">
                                            @else
                                                <img id="image-preview" class="img-thumbnail mx-auto d-block" src="#" alt="Company Logo">
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Company Details</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="details" rows="4">@if(!empty($company->details)){{$company->details}}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mr-2">@if(!empty($company->id))
                                    Update
                                @else
                                    Save
                                @endif</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                showToast("{!! \Session::get('success') !!}");
            });
            const input = document.querySelector('#image');
            const preview = document.querySelector('#image-preview');

            input.addEventListener('change', () => {
                const file = input.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.addEventListener('load', () => {
                        preview.src = reader.result;
                    });

                    reader.readAsDataURL(file);
                }
            });
        </script>
    @endsection
@endif
