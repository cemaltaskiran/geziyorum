<div class="list-group">
    <a href="{{ route('panel') }}" class="{{ isActiveURL('panel') }} list-group-item list-group-item-action">Dashboard</a>
    <a href="{{ route('panel.editAccount') }}" class="{{ isActiveURL('panel/edit-account') }} list-group-item list-group-item-action">Edit account</a>
    <a href="{{ route('panel.trips') }}" class="{{ isActiveURL('panel/trips') }} list-group-item list-group-item-action">Your trips</a>
</div>