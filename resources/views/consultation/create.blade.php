<x-app-layout>
    <x-slot name="css">
        <style>
        </style>
    </x-slot>
    <x-slot name="js">
        <script>
            $('.btn-treatment-toggle').click(function(){
                var body = `<table class="table-form table-padding-sm striped">
                                <tr>
                                    <td width="20%" class="text-right">Requested Date</td>
                                    <td>
                                        <x-bss-form.input
                                            name="date"
                                            hasIcon="right"
                                            icon="bx bx-calendar"
                                            placeholder="Date"
                                        />
                                    </td>
                                    <td width="20%" class="text-right"><small class="required">*</small> Choose Type</td>
                                    <td>
                                        <div class="d-flex">
                                            <x-bss-form.select2
                                                name="template"
                                                data-url="#"
                                                data-placeholder="Select template x-ray"
                                            />
                                            <x-form.button color="light" class="btn-add-new-template tw-ml-2" icon="bx bx-plus" label="" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">Analysed by</td>
                                    <td>
                                        <x-bss-form.select2
                                            name="analysed_by"
                                            data-url="#"
                                            data-placeholder="Select template x-ray"
                                        />
                                    </td>
                                    <td class="text-right">Selected Type</td>
                                    <td>
                                        <i class="cursor-pointer">No imagery type selected!</i>
                                    </td>
                                </tr>
                            </table>`,
                    type = $(this).data('type'),
                    title = 'Create new '+ type.toUpperCase();
                if (type=='prescription') {
                    title = 'Create new Prescription';
                    body = `<table class="table-form table-padding-sm table-striped table-medicine">
                                <thead>
                                    <tr>
                                        <th colspan="10" class="tw-bg-gray-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <x-bss-form.input
                                                    name="date"
                                                    hasIcon="right"
                                                    icon="bx bx-calendar"
                                                    placeholder="Date"
                                                />
                                                <div>
                                                    <x-form.button class="btn-add-medicine" icon="bx bx-plus" label="Add Medicine" />
                                                </div>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th width="15%">Medicine <small class="required">*</small></th>
                                        <th width="9%">Qty <small class="required">*</small></th>
                                        <th width="9%">U/D <small class="required">*</small></th>
                                        <th width="9%">NoD <small class="required">*</small></th>
                                        <th width="5%">Total</th>
                                        <th width="5%">Unit</th>
                                        <th width="15%">Usage</th>
                                        <th width="12%">Usage Time</th>
                                        <th>Note</th>
                                        <th width="8%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <x-bss-form.select2
                                                name="medicine"
                                                data-url="#"
                                                data-placeholder="Select medicine"
                                            />
                                        </td>
                                        <td>
                                            <x-bss-form.input name="qty" class="is_number"/>
                                        </td>
                                        <td>
                                            <x-bss-form.input name="ud" class="is_number"/>
                                        </td>
                                        <td>
                                            <x-bss-form.input name="nod" class="is_number"/>
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <x-bss-form.select2
                                                name="usage"
                                                data-url="#"
                                                data-placeholder="Select medicine"
                                            />
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between">
                                                <x-form.checkbox name='morning' label="Morning" />
                                                <x-form.checkbox name='noon' label="Noon" />
                                            </div>
                                            <div class="d-flex justify-content-between tw-mt-2">
                                                <x-form.checkbox name='evening' label="Evening" />
                                                <x-form.checkbox name='night' label="Night" />
                                            </div>
                                        </td>
                                        <td>
                                            <x-bss-form.textarea name="note" />
                                        </td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>`;
                }else if (type=='labor-test'){
                    body = `<div class="row align-items-center mb-1">
                                <div class="col-sm-3">
                                    <x-bss-form.input
                                        name="date"
                                        hasIcon="right"
                                        icon="bx bx-calendar"
                                        placeholder="Date"
                                    />
                                </div>
                                <div class="col-sm-3">
                                    <x-bss-form.select name="labor_service_category" class="labor-service-category">
                                        <option value="">Select Category</option>
                                        <option value="biochimie">BIOCHIMIE</option>
                                        <option value="helmatologie">HELMATOLOGIE</option>
                                    </x-bss-form.select>
                                </div>
                                <div class="col-sm-3">
                                    <x-form.checkbox name="sample_provided" label="Sample Provided" />
                                </div>
                            </div>
                            <div class="labor-service-container mt-1"></div>`;
                }
                $('#treatment-model .modal-title').html(title);
                $('#treatment-model .modal-body').html(body);
                if (type=='labor-test') {
                    $('.labor-service-category').select2({
                        dropdownAutoWidth: !0,
                        width: "100%",
                        dropdownParent: $('.labor-service-category').parent()
                    });
                }else{
                    // Select2 Ajax
                    $('.select2ajax').each((_i, e) => {
                        var $e = $(e);
                        var url = $e.data('url');
                        var placeholder = $e.data('placeholder');
                        var id = $e.attr('id');
                        if ($('#hidden_'+ id).val()=='null') {
                            $e.val('').trigger('change');
                        }
                        if ((url!='' && url!=undefined) && (placeholder!='' || placeholder!=undefined)) {
                            $e.select2({
                                width: "100%",
                                dropdownAutoWidth: !0,
                                dropdownParent: $e.parent(),
                                placeholder: placeholder,
                                allowClear: ((placeholder)? true : false),
                                delay: 500,
                                ajax: { 
                                    url: url,
                                    type: "post",
                                    dataType: 'json',
                                    delay: 250,
                                    data: function (params) {
                                        return {
                                            search: params.term
                                        };
                                    },
                                    processResults: function (data) {
                                        return {
                                            results: $.map(data, function (item) {
                                                if (Object.keys(data).length > 0) {
                                                    var keys = Object.keys(data[0]);
                                                    var rs_data = {};
                                                    keys.forEach(function(value, index) {
                                                        if (index==0) {
                                                            rs_data['id'] = item[value];
                                                        }else if(index==1){
                                                            rs_data['text'] = item[value];
                                                        }else{
                                                            rs_data[value] = item[value];
                                                        }
                                                    });
                                                    return rs_data;
                                                }
                                            })
                                        };
                                    },
                                    cache: true
                                }
                            });
                        }
                    });
                    $(document).on('change', '.select2ajax', function () {
                        var selector = $(this).attr('id');
                        $('#hidden_'+ selector).val((($(this).find("option:selected").text()=='')? 'null' : $(this).find("option:selected").text()));
                    });
                }
                $('#treatment-model').modal();
            });

            // Prescription Request
            $(document).on('click', '.btn-add-medicine', function () {
                $('.table-medicine tbody').append(`
                                                    <tr>
                                                        <td>
                                                            <x-bss-form.select2
                                                                name="medicine"
                                                                data-url="#"
                                                                data-placeholder="Select medicine"
                                                            />
                                                        </td>
                                                        <td>
                                                            <x-bss-form.input name="qty" class="is_number"/>
                                                        </td>
                                                        <td>
                                                            <x-bss-form.input name="ud" class="is_number"/>
                                                        </td>
                                                        <td>
                                                            <x-bss-form.input name="nod" class="is_number"/>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <x-bss-form.select2
                                                                name="usage"
                                                                data-url="#"
                                                                data-placeholder="Select medicine"
                                                            />
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-between">
                                                                <x-form.checkbox name='morning' label="Morning" />
                                                                <x-form.checkbox name='noon' label="Noon" />
                                                            </div>
                                                            <div class="d-flex justify-content-between tw-mt-2">
                                                                <x-form.checkbox name='evening' label="Evening" />
                                                                <x-form.checkbox name='night' label="Night" />
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <x-bss-form.textarea name="note" />
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="cursor-pointer text-danger hover:tw-text-red-600 btn-remove-medicine"><i class="bx bx-x"></i></span>
                                                        </td>
                                                    </tr>
                                                `);
            });
            $(document).on('click', '.btn-remove-medicine', function () {
                $(this).closest('tr').remove();
            });

            // Labor Service Category Selected
            $(document).on('change', '.labor-service-category', function () {
                var service_categories = '',
                    value = $(this).val();
                if (value=='biochimie') {
                    service_categories = `<div class="row mt-1 service-category">
                                            <div class="col-sm-6">
                                                <b class="text-uppercase tw-underline">
                                                    Bacteriologie
                                                </b>
                                            </div>
                                            <div class="col-sm-6 text-right">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <x-form.checkbox name="all_category_1" class="chb_all" label="All" />
                                                    <span class="tw-ml-1 tw-underline btn-remove-service-category cursor-pointer text-danger hover:tw-text-red-600"><i class="bx bx-x"></i>Remove</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 tw-mt-2">
                                                <div class="row">
                                                    <div class="col-sm-4 tw-mt-1">
                                                        <x-form.checkbox name="item_1" class="chb_child" label="Item 1" />
                                                    </div>
                                                    <div class="col-sm-4 tw-mt-1">
                                                        <x-form.checkbox name="item_2" class="chb_child" label="Item 2" />
                                                    </div>
                                                    <div class="col-sm-4 tw-mt-1">
                                                        <x-form.checkbox name="item_3" class="chb_child" label="Item 3" />
                                                    </div>
                                                    <div class="col-sm-4 tw-mt-1">
                                                        <x-form.checkbox name="item_4" class="chb_child" label="Item 4" />
                                                    </div>
                                                    <div class="col-sm-4 tw-mt-1">
                                                        <x-form.checkbox name="item_5" class="chb_child" label="Item 5" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                
                }else if (value=='helmatologie') {
                    service_categories = `<div class="row mt-1 service-category">
                                            <div class="col-sm-6">
                                                <b class="text-uppercase tw-underline">
                                                    HEMATOLOGIE
                                                </b>
                                            </div>
                                            <div class="col-sm-6 text-right">
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <x-form.checkbox name="all_category_1" class="chb_all" label="All" />
                                                    <span class="tw-ml-1 tw-underline btn-remove-service-category cursor-pointer text-danger hover:tw-text-red-600"><i class="bx bx-x"></i>Remove</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 tw-mt-2">
                                                <div class="row">
                                                    <div class="col-sm-4 tw-mt-1">
                                                        <x-form.checkbox name="item_11" class="chb_child" label="Item 1" />
                                                    </div>
                                                    <div class="col-sm-4 tw-mt-1">
                                                        <x-form.checkbox name="item_22" class="chb_child" label="Item 2" />
                                                    </div>
                                                    <div class="col-sm-4 tw-mt-1">
                                                        <x-form.checkbox name="item_33" class="chb_child" label="Item 3" />
                                                    </div>
                                                    <div class="col-sm-4 tw-mt-1">
                                                        <x-form.checkbox name="item_44" class="chb_child" label="Item 4" />
                                                    </div>
                                                    <div class="col-sm-4 tw-mt-1">
                                                        <x-form.checkbox name="item_55" class="chb_child" label="Item 5" />
                                                    </div>
                                                    <div class="col-sm-4 tw-mt-1">
                                                        <x-form.checkbox name="item_66" class="chb_child" label="Item 6" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                }
                $('.labor-service-container').append(service_categories);
            });
            $(document).on('click', '.btn-remove-service-category', function () {
                $(this).closest('.service-category').remove();
            });
            $(document).on('change', '.chb_all', function () {
                if ($(this).is(':checked')) {
                    $(this).closest('.service-category').find('.chb_child').prop('checked', true);
                } else {
                    $(this).closest('.service-category').find('.chb_child').prop('checked', false);
                }
            });
            $(document).on('change', '.chb_child', function () {
                if ($(this).is(':checked') && ($(this).closest('.service-category').find('.chb_child:checked').length == $(this).closest('.service-category').find('.chb_child').length)) {
                    $(this).closest('.service-category').find('.chb_all').prop('checked', true);
                } else {
                    $(this).closest('.service-category').find('.chb_all').prop('checked', false);
                }
            });

            $('.data_parent').change(function (){
                if ($(this).is(':checked')) {
                    $('[data-parent="'+ $(this).attr('id') +'"]').removeAttr('disabled');
                } else {
                    $('[data-parent="'+ $(this).attr('id') +'"]').attr('disabled', 'disabled');
                }
            });

            const swalWithBootstrapBtns = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-danger tw-ml-1",
                    cancelButton: "btn btn-light tw-mr-1",
                },
                buttonsStyling: false,
            });

            function formValidate(target = 'form') {
                var rs = true;
                $(target +" input,"+ target +" textarea,"+ target +" checkbox,"+ target +" radio,"+ target +" select").each(function () {
                    var attr = $(this).attr('required');
                    if ((typeof attr !== 'undefined' && attr !== false) && $(this).val() == '') {
                        var id = $(this).closest('.tab-pane').attr('aria-labelledby');
                        $('#'+ id +' i').remove();
                        $('#'+ id).click().append('<i class="bx bx-error-circle text-danger animate__animated animate__rubberBand"></i>');
                        rs = false;
                    }
                });
                return rs;
            }

            $('.btn-submit').click(function (){
                var value = $(this).val();
                $('[name="submit_option"]').val(value);
                if (value=="cancel"){
                    swalWithBootstrapBtns.fire({
                        title: "Your data is not saved yet!",
                        text: "Are you sure you want to leave this page?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: "Leave",
                        cancelButtonText: "Stay",
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $('#consultation-form').submit();
                        }
                    })
                }else{
                    if (formValidate('#consultation-form')) {
                        $('#consultation-form').submit();
                    }
                }
            });
        </script>
    </x-slot>

    <form id="consultation-form" action="{{ route($type .'.consultation.store') }}" method="post">
        @csrf
        <input type="hidden" name="submit_option" value="cancel" />
        <x-card headerClass="" footerClass="" bodyClass="">
            <x-slot name="header">
                <h4>New Consultation</h4>
            </x-slot>
            <x-slot name="action">
                <div>
                    <x-form.button class="btn-submit" value="complete" color="success" icon="bx bx-check" label="Complete" />
                    <x-form.button class="btn-submit" value="save" icon="bx bx-save" label="Save" />
                    <x-form.button class="btn-submit" value="cancel" color="danger" icon="bx bx-x" label="Cancel" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div>
                    <x-form.button class="btn-submit" value="complete" color="success" icon="bx bx-check" label="Complete" />
                    <x-form.button class="btn-submit" value="save" icon="bx bx-save" label="Save" />
                    <x-form.button class="btn-submit" value="cancel" color="danger" icon="bx bx-x" label="Cancel" />
                </div>
            </x-slot>
            <table class="table-form">
                <tr>
                    <td width="20%" class="text-right">{{ Str::ucfirst($type) }} <small class='required'>*</small></td>
                    <td width="30%">
                        @if ($patient)
                        <x-bss-form.select name="patient_id" :select2="false" readonly required>
                        <option value="{{ $patient->id }}" selected>{{ render_synonyms_name($patient->name_en, $patient->name_kh) }}</option>
                        </x-form.select2>
                        @else
                        <x-bss-form.select2 name="patient_id" data-url="{{ route('patient.getSelect2') }}" data-placeholder="---- None ----"
                            required />
                        @endif
                    </td>
                    <td width="20%" class="text-right">Payment Type</td>
                    <td>
                        <x-bss-form.select name="payment_type" data-no_search="true">
                            <option value="">Select payment type</option>
                            @foreach ($payment_types as $id => $payment_type)
                            <option value="{{ $id }}" {{ ((old('payment_type')==$id)? 'selected' : '' ) }}>{{ $payment_type }}</option>
                            @endforeach
                        </x-bss-form.select>
                    </td>
                </tr>
                <tr>
                    <td class="text-right">Doctor <small class='required'>*</small></td>
                    <td>
                        <x-bss-form.select name="doctor_id">
                            @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ ((old('doctor_id')==$id)? 'selected' : '' ) }}>{{ $doctor->name_kh }}</option>
                            @endforeach
                        </x-bss-form.select>
                    </td>
                    <td class="text-right">Evaluate at <small class='required'>*</small></td>
                    <td>
                        <x-bss-form.input name='evaluated_at' class="date-time-picker" hasIcon="right" icon="bx bx-calendar"
                            value="{{ date('Y-m-d H:i:s') }}" />
                    </td>
                </tr>
            </table>

            <ul class="nav nav-tabs mt-2 mb-0" role="tablist">
                <li class="nav-item">
                    <a class="nav-link btn-sm active" id="vital-sign-tab" data-toggle="tab" href="#vital-sign" aria-controls="vital-sign" role="tab"
                        aria-selected="true">
                        <span class="align-middle">Vital Sign</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-sm" id="past-medical-record-tab" data-toggle="tab" href="#past-medical-record"
                        aria-controls="past-medical-record" role="tab" aria-selected="false">
                        <span class="align-middle">Past medical Record</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-sm" id="examination-tab" data-toggle="tab" href="#examination" aria-controls="examination" role="tab"
                        aria-selected="false">
                        <span class="align-middle">Examination</span>
                    </a>
                </li>
                @if ($type == 'maternity')
                    <li class="nav-item">
                        <a class="nav-link btn-sm" id="maternity-tab" data-toggle="tab" href="#maternity" aria-controls="maternity" role="tab"
                            aria-selected="false">
                            <span class="align-middle">Maternity</span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link btn-sm" id="evaluation-tab" data-toggle="tab" href="#evaluation" aria-controls="evaluation" role="tab"
                        aria-selected="false">
                        <span class="align-middle">Evaluation</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-sm" id="treatment-plan-tab" data-toggle="tab" href="#treatment-plan" aria-controls="treatment-plan"
                        role="tab" aria-selected="false">
                        <span class="align-middle">Treament Plan</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content pl-0">
                <div class="tab-pane active" id="vital-sign" aria-labelledby="vital-sign-tab" role="tabpanel">
                    @include('consultation.tabs.vital_sign')
                </div>
                <div class="tab-pane" id="past-medical-record" aria-labelledby="past-medical-record-tab" role="tabpanel">
                    @include('consultation.tabs.past_medical_record')
                </div>
                <div class="tab-pane" id="examination" aria-labelledby="examination-tab" role="tabpanel">
                    @include('consultation.tabs.examination')
                </div>
                @if ($type == 'maternity')
                <div class="tab-pane" id="maternity" aria-labelledby="maternity-tab" role="tabpanel">
                    @include('maternity_consultation.tabs.maternity')
                </div>
                @endif
                <div class="tab-pane" id="evaluation" aria-labelledby="evaluation-tab" role="tabpanel">
                    @include('consultation.tabs.evaluation')
                </div>
                <div class="tab-pane" id="treatment-plan" aria-labelledby="treatment-plan-tab" role="tabpanel">
                    @include('consultation.tabs.treament_plan')
                </div>
            </div>
        </x-card>

    </form>

    <x-modal id="treatment-model" dialogClass="modal-full" data-backdrop="static" data-keyboard="false">
        <x-slot name="footer">
            <x-form.button color="danger" data-dismiss="modal" icon="bx bx-x" label="{{ __('button.cancel') }}" />
            <x-form.button icon="bx bx-save" label="{{ __('button.save') }}" />
        </x-slot>
    </x-modal>

</x-app-layout>