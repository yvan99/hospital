@include('components.dashcss')
@include('receptionist.components.aside')
<main class="main-content">
    <div class="position-relative ">
        <!--Nav Start-->
        @include('components.dasheader')
        <!--Nav End-->
    </div>
    
    <div class="content-inner container-fluid pb-0" id="page_layout">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-5 mt-5 gap-3">
            <div class="d-flex flex-column">
                <h3>Hello , {{ Auth::user()->name }}</h3>
                <p class="mb-0">Analytics Dashboard</p>
            </div>

        </div>
        <div class="row">
            <h1>row</h1>
        </div>
    </div>

    @include('components.dashfooter')
</main>
@include('components.dashjs')
