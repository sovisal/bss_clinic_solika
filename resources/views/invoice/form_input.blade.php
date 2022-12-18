<div class="row">
    <div class="col-7">
        <table class="table-form striped">
            <tr>
                <th colspan="4" class="text-left tw-bg-gray-100"><label><strong>Invoice > Exchange Rate : {{ d_exchange_rate() }} > Invoice Number : {{ @$row->code ?: $code }}</strong></label></th>
            </tr>
            <x-para-clinic.form-header :isEdit="$is_edit" :row="@$row" :patient="$patient" :doctor="$doctor" :paymentType="$payment_type" :gender="$gender" :isInvoice="true">
				<input type="hidden" value={{ @$row->code ?: $code }} />
            </x-para-clinic.form-header>
        </table>
    </div>
    <div class="col-5">
        <table class="table-form striped">
            <tr>
                <th colspan="2" class="text-left tw-bg-gray-100"><label><strong>Address</strong></label></th>
            </tr>
            <x-bss-form.address name="address_id" :value="old('address_id', @$row->address_id)" />
        </table>
    </div>
</div>