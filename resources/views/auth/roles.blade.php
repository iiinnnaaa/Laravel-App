<div class="form-group">
    <label for="role">Role:</label>
    <select name="role" id="role">
        <option value="">Select Role</option>
    </select>
    @if ($errors->has('role'))
        <span class="text-danger">{{ $errors->first('role') }}</span>
    @endif
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        $.ajax({
            url: "{{url('/fetch-roles')}}",
            type: "GET",
            cache: false,
            success: function (result) {
                $('#role').html('<option value="user">Select Role</option>');
                $.each(result.roles, function (key, value) {
                    $("#role").append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        })
    })
</script>
