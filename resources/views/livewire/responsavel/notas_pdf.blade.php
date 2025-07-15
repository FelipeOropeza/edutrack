<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notas do Aluno</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Notas do Aluno: {{ $aluno->nome }}</h2>

    <table>
        <thead>
            <tr>
                <th>Disciplina</th>
                <th>1º Bim.</th>
                <th>2º Bim.</th>
                <th>3º Bim.</th>
                <th>4º Bim.</th>
                <th>Média Final</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disciplinas as $disciplina => $dados)
                <tr>
                    <td>{{ $disciplina }}</td>
                    @for ($b = 1; $b <= 4; $b++)
                        <td>{{ number_format($dados['bimestres'][$b] ?? 0, 2) }}</td>
                    @endfor
                    <td><strong>{{ number_format($dados['mediaFinal'], 2) }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
