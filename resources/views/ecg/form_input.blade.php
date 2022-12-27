<div class="row">
    <div class="col-xl-7 col-lg-7 col-md-12">
        <table class="table-form striped">
            <tr>
                <th colspan="4" class="text-left tw-bg-gray-100">Ecg</th>
            </tr>
            <x-para-clinic.form-header
                :isEdit="$is_edit"
                :row="@$row"
                :type="$type"
                :patient="$patient"
                :doctor="$doctor"
                :paymentType="$payment_type"
                :gender="$gender"
            >
                <tr>
                    <x-bss-form.input-file-image-row
                        name="img_1"
                        path="{{ asset('images/ecgs/') }}"
                        :value="@$row->image_1"
                        :tr="false"
                        label="Image (First)"
                    />
                    <x-bss-form.input-file-image-row
                        name="img_2"
                        path="{{ asset('images/ecgs/') }}"
                        :value="@$row->image_2"
                        :tr="false"
                        label="Image (Second)"
                    />
                </tr>
            </x-para-clinic.form-header>
        </table>
    </div>
    <div class="col-xl-5 col-lg-5 col-md-12">
        <table class="table-form striped">
            <tr>
                <th colspan="2" class="text-left tw-bg-gray-100">Address</th>
            </tr>
            <x-bss-form.address name="address_id" :value="old('address_id', @$row->address_id)" />
        </table>
    </div>
</div>

<x-modal-image-crop width="500" height="320" previewWidth="200" previewHeight="128"/>