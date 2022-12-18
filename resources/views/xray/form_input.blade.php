<div class="row">
    <div class="col-8">
        <table class="table-form striped">
            <tr>
                <th colspan="4" class="text-left tw-bg-gray-100">X-Ray Code #{{ @$row->code }}</th>
            </tr>
            <x-para-clinic.form-header :isEdit="$is_edit" :row="@$row" :type="$type" :patient="$patient" :doctor="$doctor"
                :paymentType="$payment_type" :gender="$gender" />
        </table>
    </div>
    <div class="col-4">
        <table class="table-form striped">
            <tr>
                <th colspan="2" class="text-left tw-bg-gray-100">Address</th>
            </tr>
            <x-bss-form.address name="address_id" :value="old('address_id', @$row->address_id)" />
        </table>
    </div>
</div>