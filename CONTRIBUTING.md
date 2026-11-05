# Contributing to Kanka CE

Kanka CE is a community project that lives through the participation of its
members, including you!

This project is entirely maintained by volunteers: people who love Kanka, want
to self‑host it, and believe in open collaboration. Every improvement, every
fix, every idea comes from people like you. Kanka CE is still in an early stage,
so help is appreciated very much.

No contribution is too small, even a typo fix helps move the project forward.

If you want Kanka CE to grow, stay compatible, and remain self‑hostable,
please consider contributing. The Community Edition lives through its community.


## How to contribute

There are many ways to contribute:

- Reporting bugs  
- Improving documentation  
- Suggesting enhancements  
- Testing new releases  
- Submitting patches or pull requests  
- Helping others in issues and discussions  

All contributions are welcome.

If you are looking, where to start, please take a look at the [ToDo-List](https://github.com/kinnewig/kanka-community-edition/blob/develop-ce/TODO.md) 
or the open [issues](https://github.com/kinnewig/kanka-community-edition/issues).

## Reporting bugs

Bug reports are extremely valuable.  
If possible, please include:

- A clear description of the issue  
- Steps to reproduce  
- Logs or error messages (if applicable)  
- A minimal failing example, if possible  

This helps the community reproduce and fix the issue quickly.

## Submitting changes
One of the core goals of Kanka CE is to stay compatible with upstream [Kanka](https://github.com/owlchester/kanka).
Therefore, the Kanka CE development happens across two repositories.

### 1. [kanka-ce-tools](https://github.com/kinnewig/kanka-ce-tools)
This repository contains scripts, patches, and resources helping to build the Community Edition.
Typical contributions here include, changes that would otherwise break compatibility if applied directly to the source code, 
e.g., a bash scripts that replace non‑free Font Awesome icons with the free set.

### 2. [kanka-community-edition](https://github.com/kinnewig/kanka-community-edition)
On the branch [**develop-ce**](https://github.com/kinnewig/kanka-community-edition/tree/develop-ce), 
this repository contains the modified source code of Kanka, 
that is used as basis to generate the full Kanka CE with the help of the kanka-ce-tools.
If you want to submit changes that directly modify the source code, please use this branch as your starting point.

On the branch [**latest**](https://github.com/kinnewig/kanka-community-edition/tree/latest) (the default branch), 
this repository contains the generated, modified source code after applying
kanka-ce-tools to the branch develop-ce. From this branch the releases are created.

### Workflow
To propose changes:

1. **Fork** the corresponding repository  
2. Create a **feature branch** from the corresponding branch as described above
3. **Commit** your changes in small, reviewable units  
4. Open a **pull request**  

Smaller patches are easier to review and get merged faster.

## AI Contributions

At the present time, we are not accepting contributions
from autonomous AI agents. Patches may include source code created in part by an
AI tool as long as they satisfy the Developer Certificate of Origin version 1.1 and

1. The submitting author has personally read, reviewed, and understood the patch
   in its entirety.
2. The submitting author takes full responsibility for the contribution.

This is a rapidly evolving legal and technical field and these restrictions will
evolve over time. For more information, see [The Linux kernel's policy on AI
Coding Assistants](https://docs.kernel.org/next/process/coding-assistants.html)

---

## Thank you ❤️

Your contributions, no matter how small, help keep Kanka CE alive,
compatible, and self‑hostable.  
We are happy to have you here and look forward to building the Community
Edition together.
