<x-card :foot="false" body-class="px-0 tw-pb-1" header-class="pb-0 pt-1">
    <x-slot name="header">
        <h5><i class="bx bx-filter-alt"></i> Filter</h5>
    </x-slot>
    <form class="w-100 tw--mt-3" action="{!! $url !!}" method="get" id="form-filter">
        <div class="row justify-content-center">
            <div class="col-sm-3 col-md-2">
                <x-form.daterangepicker
                    name="ft_daterangepicker"
                    value="{{ request()->ft_daterangepicker }}"
                    drpStart="{{ request()->ft_daterangepicker_drp_start }}"
                    drpEnd="{{ request()->ft_daterangepicker_drp_end }}"
                    data-submit="#form-filter"
                    label="Date"
                />
            </div>
            <div class="col-sm-3 col-md-2">
                <x-form.select name="ft_patient_id" :url="route('patient.index')" onchange="$('#form-filter').submit()" label="patient">
                    <option value="">Please choose patient</option>
                    @foreach ($patient as $data)
                    <option value="{{ $data->id }}" {{ ((request()->ft_patient_id == $data->id) ? 'selected' : '') }}>{{ d_obj($data, ['name_en', 'name_kh']) }}</option>
                    @endforeach
                </x-form.select>
            </div>
            {!! $slot !!}
        </div>
    </form>
</x-card>
