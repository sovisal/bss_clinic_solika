<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('setting.address.index') . '?addr=' . @$addr }}" color="danger" icon="bx bx-left-arrow-alt" label="Back" />
    </x-slot>
    <form action="{{ route('setting.address.store') . '?addr=' . @$addr }}" method="POST" autocomplete="off" enctype="multipart/form-data">
        @csrf
        <x-card bodyClass="pb-0">
            <x-slot name="action">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>
            <x-slot name="footer">
                <div>
                    <x-form.button type="submit" class="btn-submit" value="1" icon="bx bx-save" label="Save" />
                </div>
            </x-slot>

            @include('4_level_address.form')
        </x-card>
    </form>

    <x-modal-image-crop />
</x-app-layout>