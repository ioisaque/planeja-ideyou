# Plano de execução — Adequação ao modelo EEJPII

Plano técnico revisado após implementação do **novo cabeçalho Aurélio** (jul/2026). Referência: `mudancas-sugeridas.md`.

**Premissa:** um único layout de impressão (Aurélio). Não há fase de “cabeçalho EEJPII” nem seletor de modelo visual.

---

## Status geral

| Fase | Escopo | Status |
|---|---|---|
| 0 | Cabeçalho form + PDF (período, data, sem código) | **Concluída** |
| 1 | Correções rápidas (e-mail, migração JS, limpeza) | **Concluída** |
| 2 | Novos campos (observações, objetivo geral) | **Concluída** |
| 3 | Rótulos PDF + placeholders | **Concluída** |
| 4 | Concatenação metodologia (se exigido) | Opcional |

**Esforço restante estimado:** 6–10 h (fases 1–3).

---

## Fase 0 — Concluída

### 0.1 Formulário (`index.php`)

- Removido campo `codigo`
- Linha 1: `professor` (col-5) · `turma` (col-4) · `periodo` select (col-3)
- Linha 2: `componente_curricular` (col-8) · `Data` com `periodo_i` / `periodo_f` (col-4)
- Select `periodo` com optgroups: Semestres, Trimestres, Bimestres
- Valores: `1º SEMESTRE`, `1º TRIMESTRE`, `1º BIMESTRE`, etc.
- Placeholder do select: `value="" disabled selected`

### 0.2 PDF (`print.php`)

**Linha 1** (total 210 mm):

```php
Professor(a):  23 + valor 67
Ano/Turma:     20 + valor 55
Período:       18 + valor 27   // label em negrito; 18 mm evita sobreposição com o valor
```

**Linha 2:**

```php
Área do Conhecimento/Componente Currícular:  76 + valor 89
Data:                                         12 + valor 33
```

**Nota:** blocos Período e Data têm **45 mm** cada no total; o label “Período:” precisa de **18 mm** (não 12 como “Data:”) por ser mais longo.

### 0.3 O que NÃO entrou na fase 0

- Correção do e-mail `eduacao` → `educacao`
- Migração `bimestre` no JS (foi discutida; **reimplementar** na fase 1)
- Fallback `bimestre` no `print.php` (idem)
- Campos `observacoes`, `objetivo_geral`
- Renomeação de rótulos no corpo do PDF

---

## Fase 1 — Correções rápidas

**Esforço:** 1–2 h

### 1.1 E-mail do cabeçalho

**Arquivo:** `print.php` (~linha 25)

```php
// De:
$EMAIL = "... escola.213314@eduacao.mg.gov.br";
// Para:
$EMAIL = "... escola.213314@educacao.mg.gov.br";
```

### 1.2 Migração `bimestre` → `periodo` (localStorage)

**Arquivo:** `assets/js/_ideyou.core.functions.js`

Em `visualizarPlanejamento`, antes do loop:

```javascript
if (planejamento.bimestre && !planejamento.periodo) {
    const map = {
        '1º': '1º BIMESTRE', '2º': '2º BIMESTRE',
        '3º': '3º BIMESTRE', '4º': '4º BIMESTRE',
    };
    planejamento.periodo = map[planejamento.bimestre] || planejamento.bimestre;
}
```

Ou tratar `key === 'bimestre'` dentro do loop com `continue`.

### 1.3 Fallback na impressão

**Arquivo:** `print.php`

```php
$periodo = Core::post('periodo') ?: Core::post('bimestre');
if (in_array($periodo, ['1º', '2º', '3º', '4º'], true))
    $periodo .= ' BIMESTRE';
// usar $periodo na célula, não Core::post('periodo') direto
```

### 1.4 Limpeza

**Arquivo:** `print.php`

- Remover bloco condicional `jornada` (sem campo no form)

### 1.5 Testes fase 1

| Cenário | Esperado |
|---|---|
| Imprimir com `1º SEMESTRE` | Período legível, sem sobreposição label/valor |
| Abrir planejamento antigo com `bimestre: "2º"` | Select em `2º BIMESTRE` |
| Cabeçalho PDF | Professor 67 mm; Área 89 mm; Data 33 mm |

---

## Fase 2 — Novos campos

**Esforço:** 2–3 h

### 2.1 Observações

**`index.php`** — card antes de Anexos:

```html
<textarea name="observacoes" class="form-control ..." 
  placeholder="Ponderações relevantes à aula..."></textarea>
```

**`print.php`** — bloco condicional (padrão das demais seções):

```php
if (Core::post('observacoes') != '') : ...
```

### 2.2 Objetivo geral

**`index.php`** — card antes de “Expectativa de Aprendizagem”:

```html
<textarea name="objetivo_geral" ... placeholder="Visão ampla da aprendizagem..."></textarea>
```

**`print.php`** — imprimir se preenchido, antes de Expectativa de Aprendizagem.

Opcional: no futuro, renomear label da expectativa para “Objetivos específicos” se a coordenação pedir.

### 2.3 JS / localStorage

Nenhuma alteração estrutural — `visualizarPlanejamento` e `salvarPlanejamentoLocal` já iteram por `name`.

### 2.4 Testes fase 2

| Cenário | Esperado |
|---|---|
| Salvar e reabrir com observações | Campo restaurado |
| PDF sem observações | Seção omitida |
| Planejamento antigo sem novos campos | Abre normal; campos vazios |

---

## Fase 3 — Rótulos e placeholders

**Esforço:** 2–3 h

### 3.1 Rótulos no PDF (`print.php`)

| Atual | Novo |
|---|---|
| `Unidade Temática:` | `Tema ou Unidade Temática:` |
| `Forma de Avaliação:` | `Avaliação:` |

Manter no form os labels atuais ou alinhar — decisão de UX menor.

### 3.2 Placeholders (`index.php`)

| Campo | Placeholder |
|---|---|
| unidade_tematica | Assunto da aula, alinhado ao Plano de Curso |
| objetivo_geral | Visão ampla do que se espera ao final |
| expectativa_de_aprendizagem | Habilidades e competências mensuráveis |
| habilidade | Código BNCC — descrição da habilidade |
| metodologias_de_ensino | Estratégias e sequência (início, desenvolvimento, fechamento) |
| forma_de_avaliacao | Como verificar o alcance dos objetivos |
| observacoes | Ponderações relevantes à aula |

Textos **só na tela**, nunca no PDF.

---

## Fase 4 — Opcional (só se a coordenação exigir)

**Esforço:** 2–4 h

### 4.1 Metodologia unificada na impressão

Manter 4 campos no form. No PDF, se flag ou sempre:

```php
$partes = array_filter([
    Core::post('metodologias_de_ensino'),
    ($o = Core::post('organizacao_dos_alunos')) ? "Organização dos alunos:\n$o" : '',
    ($e = Core::post('espaco_de_aula')) ? "Espaço de aula:\n$e" : '',
    ($m = Core::post('materiais_utilizados')) ? "Recursos didáticos:\n$m" : '',
]);
// Uma seção: Metodologia (Desenvolvimento da Aula)
```

**Não** unificar no formulário.

### 4.2 Endereço estilo Word

Baixa prioridade — CEP em linha separada. Só se pedirem explicitamente.

---

## Ordem de implementação

```
✅ 0. Cabeçalho Aurélio
✅ 1. E-mail + migração bimestre + limpeza jornada
✅ 2. observacoes + objetivo_geral
✅ 3. Rótulos PDF + placeholders
?  4. Metodologia concatenada (se necessário)
```

Um commit por fase.

---

## Checklist de arquivos

| Arquivo | Fase 0 | Fases pendentes |
|---|---|---|
| `index.php` | Cabeçalho reorganizado | observacoes, objetivo_geral, placeholders |
| `print.php` | Grid cabeçalho | e-mail, $periodo fallback, rótulos, novos campos, jornada |
| `assets/js/_ideyou.core.functions.js` | — | migração bimestre |

---

## Riscos

| Risco | Mitigação |
|---|---|
| Label “Período:” estreito demais | Manter 18 mm no label (não 12) |
| Planejamentos com `bimestre` | Fase 1 — JS + fallback print |
| `codigo` em saves antigos | Ignorar; campo removido |
| Coordenação quer metodologia em bloco único | Fase 4 opcional, sem mudar form |

---

## Fora de escopo

- Segundo layout de cabeçalho / modelo EEJPII visual
- Reintroduzir campo Código
- Exportar DOCX
- Backend multi-escola
- Autocomplete BNCC

---

## MVP restante (mínimo para “fechar” com a escola)

1. E-mail corrigido  
2. Migração `bimestre`  
3. Observações + Objetivo geral  
4. Rótulos: Tema ou Unidade Temática, Avaliação  

Sem isso, o cabeçalho já está pronto; falta alinhar **conteúdo pedagógico** ao Word.
