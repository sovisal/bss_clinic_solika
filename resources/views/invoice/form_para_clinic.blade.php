@if ($invoice_selection && ($invoice_selection['echography'] || $invoice_selection['ecg'] || $invoice_selection['xray'] || $invoice_selection['labor']))
    <table class="table-form table-padding-sm table-striped" id="table_para_clinic_result">
        <thead>
            <tr>
                <th width="5%"><label>{!! d_link('All', "javascript:item_check_all();")   !!}</label></th>
                <th width="10%"><label>Type <small class="required">*</small></label></th>
                <th width="30%"><label>Code / Service <small class="required">*</small></label></th>
                <th width="100px"><label>Qty <small class="required">*</small></label></th>
                <th width="100px"><label>Price <small class="required">*</small></label></th>
                <th width="100px"><label>Total <small class="required">*</small></label></th>
                <th><label>Description</label></th>
            </tr>
        </thead>
        <tbody>
            {{-- labor will add soon --}}
            @each ('invoice.form_para_clinic_sample', $invoice_selection['echography'], 'item')
            @each ('invoice.form_para_clinic_sample', $invoice_selection['ecg'], 'item')
            @each ('invoice.form_para_clinic_sample', $invoice_selection['xray'], 'item')
            @each ('invoice.form_para_clinic_sample', $invoice_selection['laboratory'], 'item')
        </tbody>
    </table>
@endif