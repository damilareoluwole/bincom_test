@extends('layout')

@section('title', 'Index')

@section('content')
    <div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->

				<!--end breadcrumb-->
                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body p-5">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-title d-flex align-items-center">
                                            <div><i class="bx bxs-edit me-1 font-22 text-primary"></i>
                                            </div>
                                            <h5 class="mb-0 text-primary">Polling Units</h5>
                                        </div>
                                        <form class="row g-3" action="{{url('/index')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <?php
                                                $states = getStates();
                                            ?>
                                            <div class="col-md-3">
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

                                            <div class="col-md-3">
                                                <label for="lga" class="form-label">LGA</label>
                                                <select class="form-select" id="lga" name="lga" onchange="get_options('wards',this.value,'#ward')" required>
                                                    <option value="">Select State First</option>
                                                </select>
                                                @if ($errors->has('lga'))
                                                    <li style="color:red;">{{ $errors->first('lga') }}</li>
                                                @endif
                                            </div>

                                            <div class="col-md-3">
                                                <label for="ward" class="form-label">Ward</label>
                                                <select class="form-select" id="ward" name="ward" onchange="get_options('polling-units',this.value,'#polling_unit')" required>
                                                    <option value="">Select LGA First</option>
                                                </select>
                                                @if ($errors->has('ward'))
                                                    <li style="color:red;">{{ $errors->first('ward') }}</li>
                                                @endif
                                            </div>

                                            <div class="col-md-3">
                                                <label for="polling_unitt" class="form-label">Polling Unit</label>
                                                <select class="form-select" id="polling_unit" name="polling_unit" required>
                                                    <option value="">Select Ward First</option>
                                                </select>
                                                @if ($errors->has('polling_unit'))
                                                    <li style="color:red;">{{ $errors->first('polling_unit') }}</li>
                                                @endif
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary px-5">Check</button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php $t = 1; ?>
                                    @if(isset($datas))
                                        @if(count($datas))
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-center">
                                                    <div><i class="bx bxs-edit me-1 font-22 text-primary"></i>
                                                    </div>
                                                    <h5 class="mb-0 text-primary">Polling Unit Result</h5>
                                                </div>

                                                <div class="card">
                                                    <div class="card-body">
                                                        <table class="table mb-0 table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th scope="col">#</th>
                                                                    <th scope="col">Political Party</th>
                                                                    <th scope="col">Result</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach($datas as $datum)
                                                                    <tr>
                                                                        <th scope="row">{{ $t++ }}</th>
                                                                        <td>{{ $datum->party_abbreviation }}</td>
                                                                        <td>{{ $datum->party_score }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endif


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
@endsection


