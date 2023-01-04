<table class="table-form striped">
    <tr>
        <th colspan="2" class="tw-bg-gray-100 text-center">
            <i class="bx bx-file"></i> List treament plan
        </th>
    </tr>
    <tr>
        <td width="30%">
            <div class="d-flex justify-content-between">
                <b>Prescription</b>
                @can('CreatePrescription')
                <x-form.button data-toggle="modal" data-target="#treatment_modal_prescriotion" color="secondary" icon="bx bx-plus" label=""/>
                @endcan
            </div>
        </td>
        <td>
            <span id="link_prescription"></span>
        </td>
    </tr>
    <tr>
        <td>
            <div class="d-flex justify-content-between">
                <b>Laboratory</b>
                @can('CreateLaboratory')
                <x-form.button data-toggle="modal" data-target="#treatment_modal_labor" color="secondary" icon="bx bx-plus" label=""/>
                @endcan
            </div>
        </td>
        <td>
            <span id="link_labor"></span>
        </td>
    </tr>
    <tr>
        <td>
            <div class="d-flex justify-content-between">
                <b>XRay</b>
                @can('CreateXRay')
                <x-form.button data-toggle="modal" data-target="#treatment_modal_xray" color="secondary" icon="bx bx-plus" label=""/>
                @endcan
            </div>
        </td>
        <td>
            <span id="link_xray"></span>
        </td>
    </tr>
    <tr>
        <td>
            <div class="d-flex justify-content-between">
                <b>Echography</b>
                @can('CreateEchography')
                <x-form.button data-toggle="modal" data-target="#treatment_modal_echo" color="secondary" icon="bx bx-plus" label=""/>
                @endcan
            </div>
        </td>
        <td>
            <span id="link_echo"></span>
        </td>
    </tr>
    <tr>
        <td>
            <div class="d-flex justify-content-between">
                <b>ECG</b>
                @can('CreateEcg')
                <x-form.button data-toggle="modal" data-target="#treatment_modal_ecg" color="secondary" icon="bx bx-plus" label=""/>
                @endcan
            </div>
        </td>
        <td>
            <span id="link_ecg"></span>
        </td>
    </tr>
</table>