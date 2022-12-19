<table class="table-form table-padding-sm table-striped" id="table_service_result">
    <thead>
        <tr>
            <th colspan="10" class="tw-bg-gray-100">
                <div class="d-flex justify-content-between align-items-center">
                    <label>Invoice > Service + Medicine</label>
                    <div>
                        <x-form.button class="btn-add-service" id="btn_add_service" icon="bx bx-plus" label="Add Service" />
                    </div>
                </div>
            </th>
        </tr>
        <tr>
            <th width="45%"><label>Service <small class="required">*</small></label></th>
            <th width="100px"><label>Qty <small class="required">*</small></label></th>
            <th width="100px"><label>Price <small class="required">*</small></label></th>
            <th width="100px"><label>Total <small class="required">*</small></label></th>
            <th><label>Description</label></th>
            <th width="80px"><label>Action</label></th>
        </tr>
    </thead>
    <tbody>
        <!-- JS dynamic & preload in Edit screen-->
        @if(@$invoice_detail_service)
            @foreach ($invoice_detail_service as $item)
                @include('invoice.form_service_sample')
            @endforeach
        @endif
    </tbody>
</table>