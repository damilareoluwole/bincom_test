@extends('layout')

@section('title', 'Party Result')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->

				<!--end breadcrumb-->
                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body p-5">
                                <?php
                                    $states = getStates();
                                    $parties = getAllParties();
                                ?>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-center">
                                            <div><i class="bx bxs-group me-1 font-22 text-primary"></i>
                                            </div>
                                            <h5 class="mb-0 text-primary">Add Party Result</h5>
                                        </div>
                                        <form class="row g-3" action="{{url('/polling-unit/result/add')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <div class="col-md-12">
                                                <label for="state" class="form-label">State</label>
                                                <select class="form-select" id="state" name="state" onchange="get_options('lgas',this.value,'#lga')" required>
                                                    <option value="">Select State</option>
                                                    @foreach($states as $state)
                                                        <option value="{{ $state->state_id }}">{{ $state->state_name }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('state'))
                                                    <li style="color:red;">{{ $errors->first('state') }}</li>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label for="lga" class="form-label">LGA</label>
                                                <select class="form-select" id="lga" name="lga" onchange="get_options('wards',this.value,'#ward')" required>
                                                    <option>Select State First</option>
                                                </select>
                                                @if ($errors->has('lga'))
                                                    <li style="color:red;">{{ $errors->first('lga') }}</li>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label for="ward" class="form-label">Ward</label>
                                                <select class="form-select" id="ward" name="ward" onchange="get_options('polling-units',this.value,'#polling_unit')" required>
                                                    <option>Select LGA First</option>
                                                </select>
                                                @if ($errors->has('ward'))
                                                    <li style="color:red;">{{ $errors->first('ward') }}</li>
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <label for="polling_unit" class="form-label">Polling Unit</label>
                                                <select class="form-select" id="polling_unit" name="polling_unit" required>
                                                    <option>Select Ward First</option>
                                                </select>
                                                @if ($errors->has('polling_unit'))
                                                    <li style="color:red;">{{ $errors->first('polling_unit') }}</li>
                                                @endif
                                            </div>
                                            @foreach($parties as $party)
                                                <div class="col-md-6">
                                                    <label for="party" class="form-label">Party</label>
                                                    <input type="text" class="form-control" name="party{{ $party->id }}" id="party{{ $party->id }}" value="{{ $party->partyid }}" placeholder="Party" disabled>
                                                </div>
                                                <input type="hidden" class="form-control" name="party{{ $party->id }}" id="party{{ $party->id }}" value="{{ $party->partyid }}" placeholder="Party">

                                                <div class="col-md-6">
                                                    <label for="result" class="form-label">Result</label>
                                                    <input type="text" class="form-control" name="result{{ $party->id }}" id="result{{ $party->id }}" placeholder="Enter Result for {{ $party->partyname }}" required>
                                                </div>
                                            @endforeach

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary px-5">Add Result</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
@endsection
