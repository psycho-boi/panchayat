<!-- resources/views/about_us.blade.php -->
@extends('layouts.master')

@section('content')
<div>

</div>
<div class="container py-5 my-5">
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8 text-center pt-5">
            <h1 class="display-4 mb-3">About Us</h1>
            <div class="border-bottom border-primary w-25 mx-auto"></div>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-4">
            <h2 class="h3 text-primary mb-4">Village Panchayat Pissurlem</h2>
            
            <div class="alert alert-info text-center mb-4">
                Established in 1962 • Constituency 18 Poriem
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="h5 card-title">Location</h3>
                            <p class="card-text">Located in Pissurlem, Taluka-Sattari, North Goa, positioned 32 km east of Panaji and 10 km from Valpoi.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="h5 card-title">Demographics</h3>
                            <div class="row text-center g-3">
                                <div class="col-6">
                                    <div class="bg-light rounded p-3">
                                        <h4 class="h2 text-primary mb-0">3,287</h4>
                                        <small class="text-muted">Population</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded p-3">
                                        <h4 class="h2 text-primary mb-0">900</h4>
                                        <small class="text-muted">Households</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="h5 card-title">Facilities</h3>
                            <div class="row g-2">
                                <div class="col-6">
                                    <div class="bg-light rounded p-2 text-center">
                                        <small>8 Temples</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded p-2 text-center">
                                        <small>7 Schools</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded p-2 text-center">
                                        <small>6 Anganwadis</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-light rounded p-2 text-center">
                                        <small>1 Health Centre</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="h5 card-title">About the Community</h3>
                            <p class="card-text">{{ $about_text ?? 'The primary language spoken by the residents is Konkani, followed by Hindi, Marathi, and English. The local communities possess extensive knowledge of flora and fauna, contributing to biodiversity conservation.' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection