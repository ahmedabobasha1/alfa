<x-dashboard.layout :title="__('dashboard.messages')">
    <div class="container-fluid">

      
            <!-- Page Header -->
                <x-dashboard.partials.page-header :header="__('dashboard.message_from'). ' ' . $message->name" :label_url="route('dashboard.contact_messages.index')" :label="__('dashboard.messages')" />
            <!-- End Page Header -->

        <div class="row">
            <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-shrink-0 me-3">
                                    <i class="fas fa-user-circle fa-2x"></i> 
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="font-size-14 mb-0">{{ $message->name }}</h5>
                                </div>
                            </div>
                            <h4 class="font-size-16">{{  $message->email  }}</h4>
                            <h4 class="font-size-16">{{  $message->phone  }}</h4>
                            
                            <h4 class="font-size-16">{{  $message->service?->name  }}</h4>
                            <h4 class="font-size-16">{{  $message->product?->name  }}</h4>
                            <p>{!! $message->message !!}</p>

                        </div>

                    </div>
                
            </div>
            <!-- end Col -->

        </div>
    </div>
</x-dashboard.layout>
