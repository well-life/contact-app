<select class="custom-select">
    <option value="" selected>All Companies</option>
    @foreach ($companies as $id => $name)
        <option value="{{ $id }}" selected>{{ $name }}</option>
    @endforeach
</select>
