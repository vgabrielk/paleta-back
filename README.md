# CAUSA TECH - BACKEND

## 📖 Sobre o Projeto

Esse repositório é a API backend de um sistema desenvolvido para advogados, oferecendo funcionalidades essenciais para a gestão de processos, clientes e atividades jurídicas. Este projeto é construído utilizando Laravel e está focado em fornecer uma estrutura robusta e segura para manipulação e armazenamento dos dados.

## Funcionalidades

🟧 - Em andamento | ✅ - Criado

##

✅ CRUD de Processos: Criação, leitura, atualização e exclusão de processos jurídicos. <br/>
✅ Gerenciamento de Clientes: Cadastro e visualização de clientes.
<br/>
🟧 Documentos: Upload, armazenamento e consulta de documentos relacionados aos processos.
<br/>
🟧 Pesquisa Avançada: Ferramentas de busca eficientes para encontrar informações rapidamente.
<br/>
🟧 Notificações e Alertas: Controle de prazos e movimentações importantes.
<br/>
✅ Autenticação: Controle de acesso + Autenticação JWT.
<br/>

## Informações principais para o CRUD de **Processos**:

1. **Número do Processo**:
    - O identificador único do processo (por exemplo, número do processo no formato CNJ ou outro padrão aplicável).
2. **Tipo de Processo**:
    - Classificação do tipo de processo (ex: cível, criminal, trabalhista, etc.).
3. **Status do Processo**:
    - O andamento do processo (ex: em andamento, finalizado, aguardando audiência, etc.).
4. **Data de Abertura**:
    - A data em que o processo foi iniciado.
5. **Data de Fechamento** (se aplicável):
    - A data de encerramento do processo, caso já tenha sido finalizado.
6. **Partes Envolvidas**:
    - Informações sobre as partes envolvidas (ex: cliente, réu, autor, advogado responsável, etc.).
7. **Advogado Responsável**:
    - Quem é o advogado responsável pelo processo. Pode estar relacionado ao cadastro de advogados do sistema.
8. **Área ou Assunto do Processo**:
    - Área jurídica (ex: direito de família, direito do consumidor, etc.).
9. **Juízo ou Vara**:
    - A vara em que o processo está sendo tratado, com a possibilidade de vincular a informações sobre o tribunal.
10. **Descrição do Processo**:
    - Resumo ou breve descrição do caso (útil para contextualização interna).
11. **Documentos Anexados**:
    - Upload de documentos relacionados ao processo, como petições, despachos, decisões, etc.
12. **Audiências Agendadas**:
    - Data e hora das audiências ou eventos relacionados ao processo.
13. **Histórico de Andamentos**:
    - Acompanhamento dos principais movimentos do processo (decisões, audiências, despachos, etc.).
14. **Valor da Causa** (se aplicável):
    - O valor envolvido no processo, especialmente importante em processos cíveis e trabalhistas.
15. **Sentenças/Decisões**:
    - Registro das sentenças e decisões importantes do processo.
16. **Links e Referências Externas**:
    - Links para consultas externas, como sites de tribunais, páginas de jurisprudência, ou links específicos do processo.
17. **Alertas e Notificações**:
    - Notificações relacionadas a prazos e movimentações importantes no processo.
18. **Prazos**:
    - Controle dos prazos processuais, incluindo alertas quando algum prazo estiver próximo do vencimento.

