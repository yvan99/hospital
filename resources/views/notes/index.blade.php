@include('components.dashcss')
@include('doctor.components.aside')

<main class="main-content">
    <div class="position-relative ">
        <!--Nav Start-->
        @include('components.dasheader')
        <!--Nav End-->
    </div>
    <div class="content-inner container-fluid pb-0" id="page_layout">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Patients Batches List</h4>

                        </div>

                    </div>
                    <div class="card-body">


                        <div class="bootstrap snippets bootdey">
                            <div class="row">
                                <div class="col-md-12 bg-white ">
                                    <div class="chat-message">
                                        @if ($notes->count() > 0)
                                            <div class="notes-area">
                                                @foreach ($notes as $note)
                                                    <div
                                                        class="message-area {{ $note->user_type === 'doctor' ? 'send' : 'receive' }}">
                                                        <p>{{ $note->message }}</p>
                                                        <span class="message-info">{{ $note->user_name }} |
                                                            {{ $note->created_at }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <p>No notes found for this batch.</p>
                                        @endif
                                    </div>
                                    <div class="chat-box bg-white">
                                        <div class="input-group">
                                            <input class="form-control border no-shadow no-rounded"
                                                placeholder="Type your message here">
                                            <span class="input-group-btn">
                                                <button class="btn btn-success no-rounded" type="button">Send</button>
                                            </span>
                                        </div><!-- /input-group -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.dashfooter')
</main>
@include('components.dashjs')
