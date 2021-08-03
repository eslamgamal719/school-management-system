@if($currentStep != 2)
    <div style="display: none" class="row setup-content" id="step-2">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <br>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('site.name_mother')}}</label>
                        <input type="text" wire:model="name_mother" class="form-control">
                        @error('name_mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('site.name_mother_en')}}</label>
                        <input type="text" wire:model="name_mother_en" class="form-control">
                        @error('name_mother_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('site.job_mother')}}</label>
                        <input type="text" wire:model="job_mother" class="form-control">
                        @error('job_mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('site.job_mother_en')}}</label>
                        <input type="text" wire:model="job_mother_en" class="form-control">
                        @error('job_mother_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('site.national_id_mother')}}</label>
                        <input type="text" wire:model="national_id_mother" class="form-control">
                        @error('national_id_mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('site.passport_id_mother')}}</label>
                        <input type="text" wire:model="passport_id_mother" class="form-control">
                        @error('passport_id_mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('site.phone_mother')}}</label>
                        <input type="text" wire:model="phone_mother" class="form-control">
                        @error('phone_mother')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('site.nationality_mother_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="nationality_mother_id">
                            <option selected>{{trans('site.choose')}}...</option>
                            @foreach($nationalities as $nationality)
                                <option value="{{$nationality->id}}">{{$nationality->name}}</option>
                            @endforeach
                        </select>
                        @error('nationality_mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('site.blood_type_mother_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="blood_type_mother_id">
                            <option selected>{{trans('site.choose')}}...</option>
                            @foreach($bloods as $blood)
                                <option value="{{$blood->id}}">{{$blood->name}}</option>
                            @endforeach
                        </select>
                        @error('blood_type_mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('site.religion_mother_id')}}</label>
                        <select class="custom-select my-1 mr-sm-2" wire:model="religion_mother_id">
                            <option selected>{{trans('site.choose')}}...</option>
                            @foreach($religions as $religion)
                                <option value="{{$religion->id}}">{{$religion->name}}</option>
                            @endforeach
                        </select>
                        @error('religion_mother_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('site.address_mother')}}</label>
                    <textarea class="form-control" wire:model="address_mother" id="exampleFormControlTextarea1"
                              rows="4"></textarea>
                    @error('address_mother')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)">
                    {{trans('site.back')}}
                </button>

                @if($update_mode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="secondStepSubmit_edit"
                            type="button">{{trans('site.Next')}}
                    </button>
                @else  
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                            wire:click="secondStepSubmit">{{trans('site.next')}}</button>
                @endif
            </div>
        </div>
    </div>