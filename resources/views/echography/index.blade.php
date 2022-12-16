<x-app-layout>
    <x-slot name="header">
        <x-form.button href="{{ route('para_clinic.echography.create') }}" label="Create" icon="bx bx-plus" />
        <form class="w-100" action="{{ route('para_clinic.echography.index') }}" method="get">
            <x-report-filter />
        </form>
    </x-slot>
    <x-slot name="css">
        <style>
            #image-slider {
                width: 600px;
                margin: 10px auto;
                overflow: hidden;
            }

            #image-slider .carousel-inner {
                border-radius: 0;
            }
        </style>
    </x-slot>
    <x-slot name="js">
        <script>
            function getImage(img_1, img_2) {
                var inner_slider;
                $('#image-modal .modal-body .no-photo').remove();
                if (img_1 != '' || img_2 != '') {
                    $('#image-modal #image-slider').removeClass('sr-only');
                    if (img_1 != '') {
                        inner_slider = `<div class="carousel-item active">
											<img src="/images/echographies/${ img_1 }" class="d-block w-100" alt="...">
										</div>`;
                    }
                    if (img_2 != '') {
                        inner_slider += `<div class="carousel-item ${ ((img_1 == '')? 'active' : '') }">
											<img src="/images/echographies/${ img_2 }" class="d-block w-100" alt="...">
										</div>`;
                    }
                    $('#image-modal #image-slider .carousel-inner').html(inner_slider);
                } else {
                    $('#image-modal #image-slider').addClass('sr-only');
                    $('#image-modal .modal-body').append('<div class="no-photo text-center py-1">No photo</div>');
                }
                $('#image-modal').modal();
            }
        </script>
    </x-slot>
    <x-card :foot="false" :action-show="false">
        <x-table class="table-hover table-striped" id="datatables" data-table="patients">
            <x-slot name="thead">
                <tr>
                    <th>No</th>
                    <th>Code</th>
                    <th>Form</th>
                    <th>Patient</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Address</th>
                    <th>Requested Date</th>
                    <th>Physician</th>
                    <th>Price</th>
                    <th>Payment</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </x-slot>
            @foreach($rows as $i => $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{!! d_link($row->code, "javascript:getDetail(" . $row->id . ", '" . route('para_clinic.echography.getDetail', 'Echography Detail') . "')") !!}</td>
                <td>{!! $row->echoTypeLink !!}</td>
                <td>{!! $row->patientLink !!}</td>
                <td>{{ d_obj($row, 'gender', ['title_en', 'title_kh']) }}</td>
                <td>{{ d_obj($row, 'age') }}</td>
                <td>{{ d_obj($row, 'address', ['village_kh', 'commune_kh', 'district_kh', 'province_kh']) }}</td>
                <td>{{ render_readable_date($row->requested_at) }}</td>
                <td>{!! $row->doctorLink !!}</td>
                <td>{{ d_currency($row->price) }}</td>
                <td>{!! d_paid_status($row->payment_status) !!}</td>
                <td>{{ d_obj($row, 'user', 'name') }}</td>
                <td>{!! d_status($row->status) !!}</td>
                <td>
                    <x-form.button color="warning" class="btn-sm" onclick="getImage('{{ $row->image_1 }}', '{{ $row->image_2 }}')" icon="bx bx-image" />
                    <x-form.button color="dark" class="btn-sm" onclick="printPopup('{{ route('para_clinic.echography.print', $row->id) }}')" icon="bx bx-printer" />
                    @if ($row->status=='1' && $row->payment_status == 0)
                    <x-form.button color="secondary" class="btn-sm" href="{{ route('para_clinic.echography.edit', $row->id) }}" icon="bx bx-edit-alt" />
                    <x-form.button color="danger" class="confirmDelete btn-sm" data-id="{{ $row->id }}" icon="bx bx-trash" />
                    <form class="sr-only" id="form-delete-{{ $row->id }}" action="{{ route('para_clinic.echography.delete', $row->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="sr-only" id="btn-{{ $row->id }}">Delete</button>
                    </form>
                    @else
                    <x-form.button color="secondary" class="btn-sm" icon="bx bx-edit-alt" disabled />
                    <x-form.button color="danger" class="btn-sm" icon="bx bx-trash" disabled />
                    @endif
                </td>
            </tr>
            @endforeach
        </x-table>
    </x-card>

    <x-para-clinic.modal-detail />

    <x-modal :foot="false" id="image-modal" dialogClass="modal-lg">
        <x-slot name="header">
            View Echography Photo
        </x-slot>
        <x-slider id="image-slider" :autoplay="false" />
    </x-modal>

    <x-modal-confirm-delete />

</x-app-layout>