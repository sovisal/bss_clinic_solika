<div class="row">
    <div class="col-8">
        <table class="table-form striped">
            <tr>
                <th colspan="4" class="text-left tw-bg-gray-100">Echo</th>
            </tr>
            <x-para-clinic.form-header :isEdit="$is_edit" :row="@$row" :type="$type" :patient="$patient" :doctor="$doctor" :paymentType="$payment_type" :gender="$gender">
                <tr valign=middle>
                    <td class="text-right">Image(First)</td>
                    <td width="30%">
                        <x-bss-form.input name="img_1" :value="old('img_1')" type="file" class="img_upload_preview" data-output="img_result_1" />
                        <img src="{{ @$row->image_1 ? '/images/echographies/' . $row->image_1 : '#' }}" alt="" id="img_result_1">
                    </td>
                    <td class="text-right">Image (Second)</td>
                    <td width="30%">
                        <x-bss-form.input name="img_2" :value="old('img_2')" type="file" class="img_upload_preview" data-output="img_result_2" />
                        <img src="{{ @$row->image_2 ? '/images/echographies/' . $row->image_2 : '#' }}" alt="" id="img_result_2">
                    </td>
                </tr>
            </x-para-clinic.form-header>
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