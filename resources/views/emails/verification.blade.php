<form method="POST" action="{{ route('verification') }}">
    @csrf
    <div class="wrapper">
        <h1>We've sent a verification code to your email</h1>
        <h3>Please enter the code to confirm your email</h3>
        <div class="code-wrapper">
            <label for="code">Verification code</label>
            <input type="number" name="verification_code">
        </div>
        <div class="actions">
            <input type="submit" value="Verify">
        </div>
    </div>
</form>
