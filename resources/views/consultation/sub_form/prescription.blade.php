<form action="{{ route('prescription.store') }}" method="POST" id="form_prescription" autocomplete="off" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <input type="hidden" name="is_treament_plan" value="1">
    <input type="hidden" name="patient_id" value="{{ $consultation->patient_id }}">
    <input type="hidden" name="consultation_id" value="{{ $consultation->id }}">
    <x-modal id="treatment_modal_prescriotion" dialogClass="modal-full" tabindex="" data-backdrop="static" data-keyboard="false" header="Create new Prescription">
        <table class="table-form table-padding-sm table-striped table-medicine">
            <thead>
                <tr>
                    <th colspan="100%" class="tw-bg-gray-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <x-bss-form.input name="requested_at" class="date-time-picker" hasIcon="right" icon="bx bx-calendar" value="{{ date('Y-m-d H:i:s') }}" required/>
                            <div>
                                <x-form.button class="btn-add-medicine" icon="bx bx-plus" label="Add Medicine" />
                            </div>
                        </div>
                    </th>
                </tr>
                @if(env('CLASSIC_PRESCRIPTION', false) == false)
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
                @else
                    <tr class="text-center">
                        <th width="15%">Medicine<small class="required">*</small></th>
                        <th width="8%">ព្រឹក<small class="required">*</small></th>
                        <th width="8%">ថ្ងៃ<small class="required">*</small></th>
                        <th width="8%">ល្ងាច<small class="required">*</small></th>
                        <th width="8%">យប់<small class="required">*</small></th>
                        <th width="8%">NoD<small class="required">*</small></th>
                        <th width="8%">Total</th>
                        <th width="5%">Unit <small class="required">*</small></th>
                        <th width="10%">Usage</th>
                        <th>Note</th>
                        <th>Action</th>
                    </tr>
                @endif
            </thead>
            <tbody>
                <!-- JS dynamic -->
            </tbody>
        </table>
        <x-slot name="footer">
            <x-form.button color="danger" data-dismiss="modal" icon="bx bx-x" label="{{ __('button.cancel') }}" />
            <x-form.button type="submit" class="prescription_submit" icon="bx bx-save" label="{{ __('button.save') }}" />
        </x-slot>
    </x-modal>
</form>
<div>
    <table id="sample_prescription" class="hidden">
        @include('prescription.form_medicine_sample')
    </table>
</div>