<x-app-layout>
    <x-slot name="js">
        @include('invoice.script')
    </x-slot>
    <x-slot name="header">
        <x-form.button href="{{ route('invoice.index') }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
    </x-slot>
    <form action="{{ route('invoice.update', $row) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input type="hidden" name="status" value="{{ $row->status ?: 1 }}" />
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="2" color="success" icon="bx bx-dollar" label="Save Paid" />
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-printer" label="Save Print" />
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="2" color="success" icon="bx bx-dollar" label="Save Paid" />
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-printer" label="Save Print" />
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>
            
            @include('invoice.form_input')
            <br />
            @include('invoice.form_service')
            <br />
            @include('invoice.form_para_clinic')
            <br />
            @include('invoice.form_footer')
        </x-card>
    </form>
    <div>
        <table id="sample_service_row" class="hidden">
            @include('invoice.form_service_sample')
        </table>
    </div>

    <x-para-clinic.modal-detail />
</x-app-layout>