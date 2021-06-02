<!DOCTYPE html> 
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>AAH+ - Prescription PDF</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		
		<style type="text/css" media="screen">
            html {
                font-family: sans-serif;
                line-height: 1.15;
                margin: 0;
            }
            body {
                font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: left;
                background-color: #fff;
                font-size: 10px;
                margin: 36pt;
            }
            h4 {
                margin-top: 0;
                margin-bottom: 0.5rem;
            }
            p {
                margin-top: 0;
                margin-bottom: 1rem;
            }
            strong {
                font-weight: bolder;
            }
            img {
                vertical-align: middle;
                border-style: none;
            }
            table {
                border-collapse: collapse;
            }
            th {
                text-align: inherit;
            }
            h4, .h4 {
                margin-bottom: 0.5rem;
                font-weight: 500;
                line-height: 1.2;
            }
            h4, .h4 {
                font-size: 1.5rem;
            }
            .table {
                width: 100%;
                margin-bottom: 1rem;
                color: #212529;
            }
            .table th,
            .table td {
                padding: 0.75rem;
                vertical-align: top;
                border-top: 1px solid #dee2e6;
            }
            .table thead th {
                vertical-align: bottom;
                border-bottom: 2px solid #dee2e6;
            }
            .table tbody + tbody {
                border-top: 2px solid #dee2e6;
            }
            .mt-5 {
                margin-top: 3rem !important;
            }
            .pr-0,
            .px-0 {
                padding-right: 0 !important;
            }
            .pl-0,
            .px-0 {
                padding-left: 0 !important;
            }
            .text-right {
                text-align: right !important;
            }
            .text-center {
                text-align: center !important;
            }
            .text-uppercase {
                text-transform: uppercase !important;
            }
            * {
                font-family: "DejaVu Sans";
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .party-header {
                font-size: 1.5rem;
                font-weight: 400;
            }
            .total-amount {
                font-size: 12px;
                font-weight: 700;
            }
            .border-0 {
                border: none !important;
            }
            
            .leftBorder {
                border-left: none !important;
            }
            
            .bottomBorder {
                border-bottom: none !important;
            }
            
            .sign {
			    max-width: 100%;
                height: 85px;
			}
        </style>

	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
	
			<!-- Page Content -->
			<div class="content">
				<div class="container-fluid">
				    
				    
				    <img src="{{asset('assets/img/logo_aah.png') }}" alt="logo">
				    	
				    	
				    	<table class="table mt-5">
                            <tbody>
                                <tr>
                                    <td class="border-0 pl-0">
                                        <p>Appointment N° : <strong>#APT00{{$appointment->id}}</strong></p>
                                        <p>Date : <strong>{{$date->format('d/m/Y')}}</strong></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    {{-- Doctor - Patient --}}
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-0 pl-0 party-header" width="48.5%">
                                    {{ __('Doctor\'s Info') }}
                                </th>
                                <th class="border-0" width="3%"></th>
                                <th class="border-0 pl-0 party-header">
                                    {{ __('Patient\'s Infos') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="px-0">
                                    
                                    <p class="seller-name">
                                       Invoice From <strong>Dr. {{$appointment->doctor->name }} {{$appointment->doctor->firstname}}</strong>
                                    </p>
                                    
                                    <p class="seller-code">
                                        Email: {{$appointment->doctor->email }}
                                    </p>
                               
                                    <p class="seller-phone">
                                        Phone : {{$appointment->doctor->phone_number }}
                                    </p>
                                
                                    <p class="seller-address">
                                        Address: {{$appointment->doctor->address }}
                                    </p>
                                    
                                </td>
                                
                                
                                <td class="border-0"></td>
                                
                                <td class="px-0">
                                    
                                    <p class="buyer-name">
                                        Invoice To <strong>{{$appointment->patient->name }} {{$appointment->patient->firstname}}</strong>
                                    </p>
                                
                                    <p class="buyer-address">
                                        Address : {{$appointment->patient->address }}
                                    </p>
                                
                                    <p class="buyer-code">
                                        Email : {{$appointment->patient->email }}
                                    </p>
                                
                                    <p class="buyer-phone">
                                        Tel : {{$appointment->patient->phone_number }}
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <br><br>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="border-0 " width="15%"></th>
                                <th class="border-0 pl-0 party-header" width="70%">{{ __('Appointment Info') }}</th>
                                <th class="border-0" width="15%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td class="border-0"></td>
                                
                                <td class="px-0">
                                    
                                    <p class="seller-name">
                                      <strong>Appointment N° : </strong>#APT00{{$appointment->id}}
                                    </p>
                                    
                                    @if($appointment->status == 0)
    								<p class="seller-name"><strong>Status : </strong>Pending</p>
    								@endif
    								
    								@if($appointment->status == 1)
    								<p class="seller-name"><strong>Status : </strong> Confirmed</p>
    								@endif
    								
    								@if($appointment->status == 2)
    								<p class="seller-name"> <strong>Status : </strong>Cancelled</p>
    								@endif
    								
    								@if($appointment->status == 3)
    								<p class="seller-name"><strong>Status : </strong>Completed</p>
    								@endif

                                    @if($appointment->status == 3)
                                    <p class="seller-name"><strong>Status : </strong>Paid</p>
                                    @endif

                                    @if($appointment->status == 4)
                                    <p class="seller-name"><strong>Status : </strong>Started</p>
                                    @endif
                                    
                                    @if($appointment->status == 5)
                                    <p class="seller-name"><strong>Status : </strong>Completed</p>
                                    @endif
                                        
                                    <p class="seller-phone">
                                        <strong>Date of appointment:</strong> {{$appointment->date_apt}} {{$appointment->begin_time}}
                                    </p>
                                    
                                    <p class="seller-phone">
                                        <strong>Schedule :</strong> {{$appointment->begin_time}} - {{$appointment->end_time}}
                                    </p>
                                    
                                    @if($appointment->confirm_date != '')
                                    <p class="seller-phone">
                                        <strong>Confirm Date :</strong> {{$appointment->confirm_date}}
                                    </p>
                                    @endif
                                    
                                    <p class="seller-name">
                                       <strong>Paid amount :</strong> ${{$appointment->apt_amount}}
                                    </p>
                                
                                </td>
                        
                                
                                
                                <td class="border-0"></td>
                            </tr>
                        </tbody>
                    </table>


								<br><br>
								<!-- Signature -->
									<div class="row">
										<div class="col-md-12 text-right">
											<div class="signature-wrap">
												<div class="signature">
													<!--Click here to sign-->
													<img class="img-fluid sign" src="{{url('/storage/signatures/'.$appointment->doctor->signature->signature_file ) }}" alt="Signature Image">
												</div>
												<div class="sign-name">
													<p class="mb-0">( Dr. {{$appointment->doctor->name}} {{$appointment->doctor->firstname}} )</p>
													<span class="text-muted">Signature</span>
												</div>
											</div>
										</div>
									</div>
									<!-- /Signature -->
								
								<!-- Invoice Information -->
								<div class="other-info">
									<h4>Other information</h4>
									<p class="text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sed dictum ligula, cursus blandit risus. Maecenas eget metus non tellus dignissim aliquam ut a ex. Maecenas sed vehicula dui, ac suscipit lacus. Sed finibus leo vitae lorem interdum, eu scelerisque tellus fermentum. Curabitur sit amet lacinia lorem. Nullam finibus pellentesque libero.</p>
								</div>
								<!-- /Invoice Information -->
								
							</div>
						</div>
					</div>

				</div>

			</div>		
			<!-- /Page Content -->
		</div>
		<!-- /Main Wrapper -->
	</body>
</html>