<div class="form-group">
    <label for="role">Choose Role:</label>
    <select name="role" id="roles">
        <option value="">Role</option>
        {{--        @foreach ($roles as $data)--}}
        {{--            <option value="{{$data->id}}">--}}
        {{--                {{$data->name}}--}}
        {{--            </option>--}}
        {{--        @endforeach--}}
    </select>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $('#roles').on('change', function () {
            console.log('hello');

            $.ajax({
                url: "{{url('/fetch-roles')}}",
                type: "GET",
                cache: false,
                success: function (result) {
                    $('#role').html('<option value="">Select Role</option>');
                    $.each(result, function (key, value) {
                        $("#roles").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            })
        })
    })
</script>
