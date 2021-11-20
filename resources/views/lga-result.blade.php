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
                                        <form class="row g-3" action="{{url('/lga/result')}}" method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <?php
                                                $states = getStates();
                                            ?>
                                            <div class="col-md-6">
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

                                            <div class="col-md-6">
                                                <label for="lga" class="form-label">LGA</label>
                                                <select class="form-select" id="lga" name="lga" onchange="get_options('wards',this.value,'#ward')" required>
                                                    <option value="">Select State First</option>
                                                </select>
                                                @if ($errors->has('lga'))
                                                    <li style="color:red;">{{ $errors->first('lga') }}</li>
                                                @endif
                                            </div>

                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary px-5">Check</button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php $t = 1; ?>
                                        @if(isset($data))
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-center">
                                                    <div><i class="bx bxs-edit me-1 font-22 text-primary"></i>
                                                    </div>
                                                    <h5 class="mb-0 text-primary">LGA Result</h5>
                                                </div>

                                                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">
                                                    <div class="col">
                                                        <div class="card radius-10 overflow-hidden">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <p class="mb-0 text-secondary font-14">{{ $data->pdp }}</p>
                                                                        <h5 class="my-0">{{ $data->pdpVote }}</h5>
                                                                    </div>
                                                                    <div class="text-success ms-auto font-30"><i class='bx bx-group'></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="card radius-10 overflow-hidden">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <p class="mb-0 text-secondary font-14">{{ $data->dpp }}</p>
                                                                        <h5 class="my-0">{{ $data->dppVote }}</h5>
                                                                    </div>
                                                                    <div class="text-success ms-auto font-30"><i class='bx bx-group'></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="card radius-10 overflow-hidden">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <p class="mb-0 text-secondary font-14">{{ $data->acn }}</p>
                                                                        <h5 class="my-0">{{ $data->acnVote }}</h5>
                                                                    </div>
                                                                    <div class="text-success ms-auto font-30"><i class='bx bx-group'></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="card radius-10 overflow-hidden">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <p class="mb-0 text-secondary font-14">{{ $data->ppa }}</p>
                                                                        <h5 class="my-0">{{ $data->ppaVote }}</h5>
                                                                    </div>
                                                                    <div class="text-success ms-auto font-30"><i class='bx bx-group'></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="card radius-10 overflow-hidden">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <p class="mb-0 text-secondary font-14">{{ $data->cdc }}</p>
                                                                        <h5 class="my-0">{{ $data->cdcVote }}</h5>
                                                                    </div>
                                                                    <div class="text-success ms-auto font-30"><i class='bx bx-group'></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="card radius-10 overflow-hidden">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <p class="mb-0 text-secondary font-14">{{ $data->jp }}</p>
                                                                        <h5 class="my-0">{{ $data->jpVote }}</h5>
                                                                    </div>
                                                                    <div class="text-success ms-auto font-30"><i class='bx bx-group'></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="card radius-10 overflow-hidden">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <p class="mb-0 text-secondary font-14">{{ $data->anpp }}</p>
                                                                        <h5 class="my-0">{{ $data->anppVote }}</h5>
                                                                    </div>
                                                                    <div class="text-success ms-auto font-30"><i class='bx bx-group'></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="card radius-10 overflow-hidden">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <p class="mb-0 text-secondary font-14">{{ $data->labo }}</p>
                                                                        <h5 class="my-0">{{ $data->laboVote }}</h5>
                                                                    </div>
                                                                    <div class="text-success ms-auto font-30"><i class='bx bx-group'></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="card radius-10 overflow-hidden">
                                                            <div class="card-body">
                                                                <div class="d-flex align-items-center">
                                                                    <div>
                                                                        <p class="mb-0 text-secondary font-14">{{ $data->cpp }}</p>
                                                                        <h5 class="my-0">{{ $data->cppVote }}</h5>
                                                                    </div>
                                                                    <div class="text-success ms-auto font-30"><i class='bx bx-group'></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
@endsection


