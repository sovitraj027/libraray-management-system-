<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="mb-0 font-size-18">Dashboard</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @isset($parentPageUrl)
                        <li class="breadcrumb-item"><a href="{{$parentPageUrl}}">{{$parentPageTitle}}</a></li>
                    @endisset
                    <li class="breadcrumb-item active">{{$currentPageTitle}}</li>
                </ol>
            </div>

        </div>
    </div>
</div>

