@extends('layout.app')

@section('content')

    <!-- Register Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="contact__form">
                        <div class="section-title">
                            <h2>Registration Form</h2>
                        </div>
                        <form action="{{URL::to('registerUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Name">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" placeholder="Email">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="pass" placeholder="Password">
                                    @if ($errors->has('pass'))
                                        <span class="text-danger">{{$errors->first('pass')}}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <input type="file" name="pic">
                                </div>
                                <div class="col-lg-12 text-center">
                                    
                                    <button type="submit" name="register" class="site-btn">Sign Up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Register Section End -->

@endsection