@extends('layouts.master_loggedout' ,['page_title' => 'Sign in'])
@section('content')
<div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-image:url('http://beta.menainsurancekyc.com/assets/img/mt-1421-slider-img01.jpg') ">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
						<!--begin::Content-->
						<div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
							<!--begin::Logo-->
							<a href="#" class="py-9">
								<img alt="Logo" src="http://beta.menainsurancekyc.com/assets/img/mt-1421-slider-img01.jpg" style="visibility:hidden" class="h-70px" />
							</a>
							<!--end::Logo-->
							<!--begin::Title-->
							<h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #fff;">Welcome to Mena Insurance KYC</h1>
							<!--end::Title-->
							<!--begin::Description-->
							<p class="fw-bold fs-2" style="color: #fff;">Professional Investment Management
							<br />Join 30.000+ Clients that Entrust Their Money to Us</p>
							<!--end::Description-->
						</div>
						<!--end::Content-->
						<!--begin::Illustration-->
						<!-- <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url(assets/media/illustrations/checkout.png)"></div> -->
						<!--end::Illustration-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Aside-->
				<!--begin::Body-->
				<div class="d-flex flex-column flex-lg-row-fluid py-10">
					<!--begin::Content-->
					<div class="d-flex flex-center flex-column flex-column-fluid">
						<!--begin::Wrapper-->
						<div class="w-lg-500px p-10 p-lg-15 mx-auto">
							<!--begin::Form-->
							<form method="POST" action="{{ route('login') }}" class="form w-100" novalidate="novalidate" id="kt_sign_in_form" action="#">
                            @csrf

                            <!--begin::Heading-->
								<div class="text-center mb-10">
									<!--begin::Title-->
									<h1 class="text-dark mb-3">Mena Insurance Admin Panel</h1>
									<!--end::Title-->
									<!--begin::Link-->
									<!-- <div class="text-gray-400 fw-bold fs-4">New Here?
									<a href="authentication/flows/aside/sign-up.html" class="link-primary fw-bolder">Create an Account</a></div> -->
									<!--end::Link-->
								</div>
								<!--begin::Heading-->
								<!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" required type="text" name="email" autocomplete="off" />
                                        <!--end::Input-->
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                        @if ($message = Session::get('error'))
                                            <span class="invalid-feedback d-flex" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-10">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack mb-2">
                                            <!--begin::Label-->
                                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                                            <!--end::Label-->
                                            <!--begin::Link-->
                                            <!-- <a href="authentication/flows/aside/password-reset.html" class="link-primary fs-6 fw-bolder">Forgot Password ?</a> -->
                                            <!--end::Link-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Input-->
                                        <input class="form-control form-control-lg form-control-solid @error('password') is-invalid @enderror" type="password"  required name="password" autocomplete="off" />
                                        <!--end::Input-->
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
								<!--end::Input group-->
								<!--begin::Actions-->
								<div class="text-center">
									<!--begin::Submit button-->
									<button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
										<span class="indicator-label">Continue</span>
										<span class="indicator-progress">Please wait...
										<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
									</button>
									<!--end::Submit button-->
									<!--begin::Separator-->
									<!-- <div class="text-center text-muted text-uppercase fw-bolder mb-5">or</div> -->
									<!--end::Separator-->
									<!--begin::Google link-->

									<!--end::Google link-->
								</div>
                                <!--end::Actions-->
							</form>
							<!--end::Form-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Content-->
					<!--begin::Footer-->
					<div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
						<!--begin::Links-->
						<!-- <div class="d-flex flex-center fw-bold fs-6">
							<a href="https://keenthemes.com/faqs" class="text-muted text-hover-primary px-2" target="_blank">About</a>
							<a href="https://keenthemes.com/support" class="text-muted text-hover-primary px-2" target="_blank">Support</a>
							<a href="https://1.envato.market/EA4JP" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
						</div> -->
						<!--end::Links-->
					</div>
					<!--end::Footer-->
				</div>
				<!--end::Body-->
@endsection
