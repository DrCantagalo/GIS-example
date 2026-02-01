<div class="container">
    <h1>Autorizar Acesso</h1>
    <p>O sistema <strong>Laravel Cantagalo</strong> quer acessar seus dados.</p>

    <form method="post" action="{{ route('passport.authorizations.approve') }}">
        @csrf
        <input type="hidden" name="state" value="{{ $request->state }}">
        <input type="hidden" name="client_id" value="{{ $client->id }}">
        <input type="hidden" name="auth_token" value="{{ $authToken }}">
        <button type="submit">Sim, eu permito</button>
    </form>

    <form method="post" action="{{ route('passport.authorizations.deny') }}">
        @csrf
        @method('DELETE')
        <input type="hidden" name="state" value="{{ $request->state }}">
        <input type="hidden" name="auth_token" value="{{ $authToken }}">
        <button type="submit">Não</button>
    </form>
</div>