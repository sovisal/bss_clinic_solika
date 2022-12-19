@if ($invoice_selection)
    <table class="table-form table-padding-sm table-striped" id="table_service_result">
        <thead>
            <tr>
                <th colspan="10" class="tw-bg-gray-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <label>Invoice > Service + Medicine + Echo + Laor + XRay + ECG</label>
                        <div>
                            <x-form.button class="btn-add-service" icon="bx bx-plus" label="Add Service" />
                        </div>
                    </div>
                </th>
            </tr>
            <tr>
                <th width="5%">
                    <label>{!! d_link('All', "javascript:item_check_all();")   !!}</label>
                </th>
                <th width="10%"><label>Type <small class="required">*</small></label></th>
                <th width="35%"><label>Code / Service <small class="required">*</small></label></th>
                <th width="100px"><label>Qty <small class="required">*</small></label></th>
                <th width="100px"><label>Price <small class="required">*</small></label></th>
                <th width="100px"><label>Total <small class="required">*</small></label></th>
                <th><label>Description</label></th>
                <th width="80px"><label>Action</label></th>
            </tr>
        </thead>
        <tbody>
            <!-- JS dynamic & preload in Edit screen-->
            @each ('invoice.item', $invoice_selection['echography'], 'item')
            @each ('invoice.item', $invoice_selection['ecg'], 'item')
            @each ('invoice.item', $invoice_selection['xray'], 'item')
            @each ('invoice.item', $invoice_selection['labor'], 'item')
        </tbody>
    </table>
@endif