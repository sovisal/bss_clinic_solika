<x-app-layout>
	<x-slot name="js">
		<script>
			localStorage.setItem("treament_plan_tab", '');
		</script>
	</x-slot>
	<x-slot name="header">
		<x-form.button href="{{ route('patient.create') }}" class="btn-sm" icon="bx bx-plus" label="Create" />
	</x-slot>
	<x-card :foot="false" :head="false">
		<x-table class="table-hover table-striped table-padding-sm" id="datatables" data-table="patients">
			<x-slot name="thead">
				<tr>
					<th>N&deg;</th>
					<th>Code</th>
					<th>Name EN + Name KH</th>
					<th>Date of birth</th>
					<th>Gender</th>
					<th>Phone</th>
					<th>Nationality</th>
					<th>Registered at</th>
					<th>Status</th>
					<!-- <th>Modify at</th> -->
					<!-- <th>Modify by</th> -->
					<th width="10%">{!! __('table.action') !!}</th>
				</tr>
			</x-slot>
			@foreach ($patients as $key => $patient)
				@php 
					if ($patient->consultations() ?? false) {
						$consultant = $patient->consultations()->first();
					}
					$status = $consultant ? $consultant->status : 1;
				@endphp
				<tr>
					<td class="text-center">
						{{ ++$key }}
					</td>
					<td class="text-center">
						{{-- <a href="{{ route('patient.consultation.edit', $consultant) }}"> --}}
							PT-{!! str_pad($patient->id, 6, '0', STR_PAD_LEFT) !!}
						{{-- </a> --}}
					</td>
					<td>{!! render_synonyms_name($patient->name_en, $patient->name_kh) !!}</td>
					<td class="text-center">{!! (($patient->date_of_birth)? date('d-M-Y', strtotime($patient->date_of_birth)) : '') !!}</td>
					<td class="text-center">{!! getParentDataByType('gender', $patient->gender) !!}</td>
					<td>{!! $patient->phone !!}</td>
					<td>{!! getParentDataByType('nationality', $patient->nationality) !!}</td>
					<td class="text-center">{!! (($patient->registered_at!==null)? date('d-M-Y H:i', strtotime($patient->registered_at)) : '-') !!}</td>
					<!-- <td>{!! date('d-M-Y H:i', strtotime($patient->updated_at)) !!}</td> -->
					<!-- <td>{!! $patient->updated_by_name !!}</td> -->
					<td class="text-center">{!! render_record_status($status) !!}</td>
					<td class="text-right">
                        <x-table-action-btn module="patient" :id="$patient->id" :isTrashed="$patient->trashed()" :disableEdit="$status != 1" :disableDelete="$status != 1" />
					</td>
				</tr>
			@endforeach
		</x-table>
	</x-card>
	
	<x-modal-confirm-delete />

</x-app-layout>
