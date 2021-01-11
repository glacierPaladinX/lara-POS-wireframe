@extends( 'layout.dashboard' )

@section( 'layout.dashboard.body' )
<div class="h-full flex-auto flex flex-col">
    @include( Hook::filter( 'ns-dashboard-header', '../common/dashboard-header' ) )
    <div class="px-4 flex-auto flex flex-col" id="dashboard-content">
        <div class="page-inner-header mb-4">
            <h3 class="text-3xl text-gray-800 font-bold">{{ $title ?? __( 'Unamed Page' ) }}</h3>
            <p class="text-gray-600">{{ $description ?? __( 'No Description Provided' ) }}</p>
        </div>
        <ns-procurement
            submit-url="{{ ns()->url( '/api/nexopos/v4/procurements/' . $procurement->id ) }}"
            submit-method="put"
            src="{{ ns()->url( '/api/nexopos/v4/forms/ns.procurement/' . $procurement->id ) }}"
            return-url="{{ ns()->url( '/dashboard/procurements' ) }}">
            <template v-slot:title>{{ __( 'Procurement Name' ) }}</template>
        </ns-procurement>
    </div>
</div>
@endsection