@include('components.dashcss')
@include('receptionist.components.aside')
<main class="main-content">
    <div class="position-relative ">
        <!--Nav Start-->
        @include('components.dasheader')
        <!--Nav End-->
    </div>
    <div class="content-inner container-fluid pb-0" id="page_layout">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            @forelse ($invitations as $invitation)
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header d-flex text-center flex-column align-items-center justify-content-between">
                            <h4>{{ $invitation->receptionist->names }}, Sent a Request </h4>
                            <p class="mt-4">{{ $invitation->message }}</p>

                            <div class="mt-4 d-flex">
                                <form method="POST" action="{{ route('schedule.approve') }}">
                                    @csrf
                                    <input type="hidden" name="invitation" value="{{ $invitation->id }}">
                                    <input type="hidden" name="choice" value="reject">
                                    <button type="submit" class="btn btn-danger mr-2" data-bs-toggle="modal" data-bs-target="#createDoctorModal">
                                        reject
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('schedule.approve') }}" class="ml-2" style="margin-left: 5px">
                                    @csrf
                                    <input type="hidden" name="invitation" value="{{ $invitation->id }}">
                                    <input type="hidden" name="choice" value="approve">
                                    <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createDoctorModal">
                                        Confurm
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card shadow-none">
                    <div class="card-header d-flex flex-column align-items-center justify-content-between">
                        <h4>No Schedule updates found</h4>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    @include('components.dashfooter')
</main>
@include('components.dashjs')
