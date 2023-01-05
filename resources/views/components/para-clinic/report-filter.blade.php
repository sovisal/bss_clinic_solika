<form class="w-100" action="{!! $url !!}" method="get">
    <div class="row justify-content-center" style="margin-top: -40px">
        <div class="col-sm-3 col-md-2">
            <x-form.daterangepicker name="ft_daterangepicker" label="Date" value="{{ request()->ft_daterangepicker }}" drpStart="{{ request()->ft_daterangepicker_drp_start }}" drpEnd="{{ request()->ft_daterangepicker_drp_end }}" />
        </div>
        <div class="col-sm-3 col-md-2">
            <x-form.select name="ft_patient_id" :url="route('patient.index')" label="patient">
                <option value="">Please choose patient</option>
                @foreach ($patient as $data)
                <option value="{{ $data->id }}" {{ ((request()->ft_patient_id == $data->id) ? 'selected' : '') }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
                @endforeach
            </x-form.select>
        </div>
        <div class="col-md-auto">
            <div class="form-group">
                <label>​ ​</label>
                <x-form.button type="submit" color="dark" name="filter-btn-search" id="filter-btn-search" class="mt-0 btn-block btn-search-filter" icon="bx bx-search" label="{{ __('button.search') }}" />
            </div>
        </div>
    </div>
</form>