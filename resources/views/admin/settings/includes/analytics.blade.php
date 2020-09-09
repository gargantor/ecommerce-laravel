<div class="tile">
    <form action="{{ route('admin.settings.update')}}" method="post" role="form">
        @csrf
        <h3 class="tile-title">Analytics</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label for="google_analytics" class="control-label">Google Analytics Code</label>
                <textarea
                    class="form-control"
                    rows="4"
                    placeholder="Enter google analytics code"
                    id="google_analytics"
                    name="google_analytics"

                >{{!! config::get('settings.google_analytics') !!}}</textarea>
            </div>
            <div class="form-group">
                <label for="facebook_pixels" class="control-label">Facebook Pixel Code</label>
                <textarea
                    class="form-control"
                    rows="4"
                    placeholder="Enter facebook pixel code"
                    id="facebook_pixels"
                    name="facebook_pixels"
                >{{config('settings.facebook_pixels') }}</textarea>
            </div>
        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                </div>
            </div>
        </div>
    </form>
</div>
