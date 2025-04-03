<form action="{{ route('assinatura.criar') }}" method="POST">
    @csrf
    <label for="email">Email do Cliente:</label>
    <input type="email" name="email" required>

    <label for="valor">Valor do Plano:</label>
    <input type="number" name="valor" step="0.01" required>

    <button type="submit">Criar Assinatura</button>
</form>
