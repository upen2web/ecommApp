@extends('layout.app')

@section('content')

    <!-- Register Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-6 col-md-6 mx-auto">
                    <div class="contact__form">
                        <div class="section-title">
                            <h2>Login Form</h2>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                <p>{{ session()->get('success') }}</p>
                            </div>
                        @endif

                        @if (session()->has('error'))
                            <div class="alert alert-danger">
                                <p>{{ session()->get('error') }}</p>
                            </div>
                        @endif
                        <form action="{{URL::to('loginUser')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="mail" placeholder="Email Id..">
                                    @if ($errors->has('mail'))
                                        <span class="text-danger">{{$errors->first('mail')}}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <input type="password" name="password" placeholder="Password..">
                                    @if ($errors->has('password'))
                                        <span class="text-danger">{{$errors->first('password')}}</span>
                                    @endif
                                </div>
                                
                                <div class="col-lg-12 text-center">
                                    
                                    <button type="submit" name="login" class="site-btn">Login</button>
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