# Coding Instructions

## Working Style
- Be concise and action-oriented. Avoid unnecessary explanations and repeated summaries.
- Inspect only files relevant to the current task.
- Do not scan the entire repository unless necessary.
- Before editing, briefly state the plan for non-trivial changes.
- Ask before destructive operations or major architectural changes.

## Token Efficiency
- Reuse information already established in the current conversation.
- Do not reread files unless they changed or need verification.
- Prefer targeted searches and specific file references over broad searches.
- Run focused tests before the full test suite.
- Keep terminal output concise; use quiet flags where available.
- Do not print entire files, logs, dependency trees, or stack traces when a relevant excerpt will suffice.
- Avoid unnecessary subagents, repeated planning, and redundant verification.
- Do not repeat code in your final response unless requested.

## Code Quality
- Make the smallest correct change that solves the problem.
- Follow existing project conventions and reuse existing utilities.
- Do not introduce dependencies without a clear need.
- Never claim a test passed unless it actually ran successfully.
- Explain the root cause of bugs and any important trade-offs.

## Final Response
Summarize:
1. What changed.
2. Files modified.
3. Tests performed and results.
4. Any remaining issues.