# Mudanças sugeridas — Aurélio × Modelo EEJPII

Comparação entre o PDF do app e o modelo **Plano de aula novo.docx** da Escola Estadual João Paulo II.

**Decisão de produto (jul/2026):** o layout de impressão **permanece o Aurélio** — não há “cabeçalho da escola” nem segundo modelo visual. O alinhamento com a coordenação é de **conteúdo e rótulos das seções**, não de reformular o documento inteiro.

---

## Já implementado

| Item | Onde | Detalhe |
|---|---|---|
| Campo **Código** removido | `index.php`, `print.php` | Espço realocado no cabeçalho |
| **Período letivo** (semestre/trimestre/bimestre) | `index.php`, `print.php` | Select com optgroups; valores completos (`1º SEMESTRE`, etc.) |
| **Data** separada do período letivo | `index.php`, `print.php` | Label “Data”; `periodo_i` à `periodo_f` |
| Cabeçalho reorganizado (form + PDF) | `index.php`, `print.php` | Ver estrutura abaixo |
| Área de Conhecimento ampliada | `index.php`, `print.php` | Mais espaço na linha 2 |
| Label **Período:** em negrito no PDF | `print.php` | Após Ano/Turma; largura 18+27 mm (label maior que “Data:” para evitar sobreposição) |
| Nome do professor ampliado no PDF | `print.php` | 67 mm (era 50 mm) |

### Cabeçalho atual — formulário

**Linha 1:** Professor (5) · Ano/Turma (4) · Período select (3)  
**Linha 2:** Área de Conhecimento/Componente Currícular (8) · Data (4)

### Cabeçalho atual — PDF (210 mm)

**Linha 1**

| Campo | Label | Valor |
|---|---|---|
| Professor(a) | 23 mm | 67 mm |
| Ano/Turma | 20 mm | 55 mm |
| Período | 18 mm | 27 mm |

**Linha 2**

| Campo | Label | Valor |
|---|---|---|
| Área do Conhecimento/Componente Currícular | 76 mm | 89 mm |
| Data | 12 mm | 33 mm |

Corpo do documento (Unidade Temática, Habilidade, Metodologias, Anexos, etc.) **inalterado** em relação ao Aurélio original.

---

## Resumo executivo

O Aurélio produz um **planejamento curricular amplo** (BNCC, múltiplas seções, anexos com QR). O Word da escola pede um **plano de aula enxuto** (menos campos, mais narrativo).

O modelo da escola não deve ser copiado à risca: mistura instruções com formulário, fixa “Trimestre”, omite anexos e campos BNCC úteis. O caminho sensato é **manter o layout Aurélio** e adotar do Word só o que agrega, principalmente **nomenclatura e campos de conteúdo** que a coordenação passa a exigir.

---

## Mapa de correspondência (atualizado)

| Modelo escola | Aurélio hoje | Veredito |
|---|---|---|
| Cabeçalho institucional | Logo + escola + endereço + telefone | Manter layout Aurélio; corrigir e-mail |
| Professor (a) | Professor | OK |
| Ano/Turma | Ano/Turma | OK |
| Trimestre | Período (semestre/trimestre/bimestre) | **Feito** — flexível, melhor que o Word |
| Período (datas) | Data (`periodo_i` / `periodo_f`) | **Feito** |
| Área de Conhecimento/Componente Curricular | `componente_curricular` | **Feito** — mais largo na linha 2 |
| Código | — | **Removido** (decisão do produto) |
| Tema ou Unidade Temática | `unidade_tematica` | Renomear label no PDF (pendente) |
| Objetivos (geral + específicos) | `expectativa_de_aprendizagem` | Adicionar `objetivo_geral`; mapear expectativa → objetivos específicos (pendente) |
| Habilidades (códigos BNCC) | `habilidade` | Manter; melhorar placeholder (pendente) |
| Metodologia (Desenvolvimento da Aula) | metodologias + materiais + organização + espaço | Manter campos no form; **concatenar só se a escola exigir texto único** (pendente) |
| Avaliação | `forma_de_avaliacao` | Renomear label para “Avaliação” (pendente) |
| Observações | — | **Adicionar campo** (pendente) |
| — | `objeto_de_conhecimento` | Manter |
| — | `competencias_especificas` | Manter |
| — | Anexos com QR | **Manter** |

---

## O que o modelo da escola faz mal (e o app não deve copiar)

### 1. Cabeçalho no formato Word
Professor, turma, trimestre e datas em linhas “de formulário” genérico. O Aurélio já tem cabeçalho tabular mais legível — **não trocar**.

### 2. Campo fixo “Trimestre”
O select com Semestres / Trimestres / Bimestres é superior. **Não regredir.**

### 3. Texto instrucional no corpo
Orientações do Word (“Descrever o que espera…”) viram **placeholder na tela**, nunca no PDF.

### 4. Metodologia como campo único
Manter campos separados no formulário. Se precisar entregar um bloco só, concatenar **na impressão**, com subtítulos.

### 5. Omissão de BNCC e anexos
Não remover Objeto de Conhecimento, Competências nem Anexos/QR.

### 6. E-mail inconsistente
- Escola: `escola.213314@educacao.mg.gov.br`
- App: `escola.213314@eduacao.mg.gov.br` (typo)

Corrigir em `print.php` (pendente).

---

## Mudanças pendentes que ainda fazem sentido

### Prioridade alta — conteúdo pedagógico

| # | Mudança | Motivo |
|---|---|---|
| 1 | Campo **Observações** | **Feito** |
| 2 | Campo **Objetivo geral** | **Feito** |
| 3 | Corrigir **e-mail** do cabeçalho | **Feito** |
| 4 | **Migração localStorage** `bimestre` → `periodo` | **Feito** |

### Prioridade média — rótulos e UX

| # | Mudança | Motivo |
|---|---|---|
| 5 | PDF: `Unidade Temática` → `Tema ou Unidade Temática` | **Feito** |
| 6 | PDF: `Forma de Avaliação` → `Avaliação` | **Feito** |
| 7 | Placeholders com texto do Word | **Feito** |
| 8 | Placeholder em Habilidades: “código — descrição” | **Feito** |
| 9 | Remover bloco `jornada` morto em `print.php` | **Feito** |

### Prioridade baixa — só se a coordenação exigir

| # | Mudança | Motivo |
|---|---|---|
| 10 | Concatenar metodologia num bloco único no PDF | Escola descreve assim; form pode continuar separado |
| 11 | Endereço no formato do Word (CEP em linha separada) | Cosmético; layout Aurélio já funciona |

### Não fazer

| Ideia | Por quê |
|---|---|
| Dois layouts de cabeçalho (Aurélio vs escola) | Decisão: um layout só |
| Reintroduzir Código | Removido de propósito |
| Apagar campos BNCC | Perda de valor |
| Um textarea “Metodologia” no form | Pior UX |
| Imprimir textos de ajuda do Word | Documento amador |

---

## Estrutura alvo — cabeçalho (definida, implementada)

```
[Cabeçalho institucional Aurélio — logo, escola, endereço, telefone]

Professor(a): …………    Ano/Turma: ………    Período: 1º SEMESTRE
Área do Conhecimento/Componente Currícular: …………………    Data: 04/05/26 à 29/05/26

[Corpo — seções atuais do Aurélio, com rótulos a ajustar]
```

---

## Estrutura alvo — corpo (evolução sugerida)

Ordem atual mantida. Inclusões e renomeações:

1. Tema ou Unidade Temática *(rename)*
2. Objeto de Conhecimento *(manter)*
3. Habilidade *(manter)*
4. Competências Específicas *(manter)*
5. **Objetivo geral** *(novo)*
6. Expectativa de Aprendizagem *(ou “Objetivos específicos” no PDF)*
7. Espaço de Aula, Materiais, Organização, Metodologias *(manter separados no form)*
8. Avaliação *(rename)*
9. **Observações** *(novo)*
10. Anexos *(manter)*

---

## Migração de dados (localStorage)

| Chave antiga | Situação |
|---|---|
| `bimestre` (`1º`…`4º`) | Select não casa; precisa mapear para `1º BIMESTRE`, etc. no JS |
| `codigo` | Ignorado — campo removido |
| `periodo` | Valores novos (`1º SEMESTRE`, …) |

Campos futuros (`objetivo_geral`, `observacoes`) devem ser opcionais — sem breaking change.

---

## Critério de sucesso

1. Cabeçalho Aurélio reorganizado atende uso diário do professor (**feito**).
2. Coordenação aceita o PDF com **rótulos e campos de conteúdo** alinhados ao Word, **sem mudar o layout geral**.
3. Planejamentos antigos abrem e imprimem corretamente após migração `bimestre` → `periodo`.
4. Formulário não fica mais pesado que o necessário — novos campos opcionais.
